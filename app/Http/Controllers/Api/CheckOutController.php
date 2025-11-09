<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\BillingDetails;
use App\Services\OrderService;
use App\Models\ShippingDetails;
use App\Services\BillingService;
use App\Services\PaymentService;
use App\Http\Controllers\Controller;
use App\Services\OrderDetailService;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ShippingRequest;
use App\Models\Product;
use App\Models\Variation;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class CheckOutController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::where('is_active', '1')
                ->with('subcategories')
                ->limit(12)
                ->get();

            $cities = config('constant.cities');

            // Load Cart (Auth or Guest)
            if (Auth::user()) {
                $cart = Cart::where('user_id', Auth::id())->get();
            } else {
                $sessionCart = session()->get('cart', []);
                $cart = collect($sessionCart)->map(function ($item) {
                    $product   = Product::with('images')->find($item['product_id']);
                    $variation = Variation::find($item['variation_id']);
                    return (object) [
                        'product_id'   => $item['product_id'],
                        'variation_id' => $item['variation_id'],
                        'quantity'     => $item['quantity'],
                        'product'      => $product,
                        'variation'    => $variation,
                    ];
                })->values();
            }

            // Calculate initial values
            $subtotal = $this->calculateSubtotal($cart);
            $totalWeight = $this->calculateTotalWeight($cart);
            
            // Initial shipping charges (will be updated via AJAX based on user's city selection)
            $shippingCharges = 0;
            $grandTotal = $subtotal + $shippingCharges;

            return view('website.pages.checkout', compact(
                'categories',
                'cart',
                'cities',
                'subtotal',
                'totalWeight',
                'shippingCharges',
                'grandTotal'
            ));
        } catch (\Throwable $th) {
            Log::error('Checkout page error: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Unable to load checkout page. Please try again.');
        }
    }

    /**
     * Calculate shipping charges via AJAX
     */
    public function calculateShipping(Request $request)
    {
        try {
            $request->validate([
                'city' => 'required|string',
                'payment_method' => 'required|string|in:cod,online_transfer'
            ]);

            // Get cart items
            if (Auth::user()) {
                $cart = Cart::where('user_id', Auth::id())->get();
            } else {
                $sessionCart = session()->get('cart', []);
                $cart = collect($sessionCart)->map(function ($item) {
                    $product = Product::find($item['product_id']);
                    $variation = Variation::find($item['variation_id']);
                    return (object) [
                        'product' => $product,
                        'variation' => $variation,
                        'quantity' => $item['quantity'],
                    ];
                });
            }

            if ($cart->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Cart is empty',
                    'shipping_charges' => 0,
                    'grand_total' => 0
                ]);
            }

            $totalWeight = $this->calculateTotalWeight($cart);
            $subtotal = $this->calculateSubtotal($cart);
            $codAmount = $request->payment_method === 'cod' ? $subtotal : 0;

            // Since TCS doesn't have a calculator API, use our fallback calculation
            $shippingCharges = $this->calculateFallbackShipping($totalWeight, $codAmount, $request->city);
            
            $grandTotal = $subtotal + $shippingCharges;

            return response()->json([
                'success' => true,
                'shipping_charges' => $shippingCharges,
                'grand_total' => $grandTotal,
                'subtotal' => $subtotal,
                'calculation_type' => 'fallback_calculation',
                'weight' => $totalWeight,
                'message' => 'Shipping calculated using standard rates'
            ]);

        } catch (\Throwable $th) {
            Log::error('Shipping calculation error: ' . $th->getMessage());
            
            // Emergency fallback with flat rate
            $fallbackCharge = 250;
            $subtotal = $this->calculateSubtotal($cart) ?? 0;
            
            return response()->json([
                'success' => false,
                'shipping_charges' => $fallbackCharge,
                'grand_total' => $subtotal + $fallbackCharge,
                'error' => 'Failed to calculate shipping charges. Using standard rates.',
                'calculation_type' => 'emergency_fallback'
            ]);
        }
    }

    /**
     * Improved Fallback shipping calculator based on TCS pricing structure
     */
    private function calculateFallbackShipping($weight, $codAmount, $destinationCity)
    {
        // Base rates from TCS documentation analysis
        $baseRates = [
            'local' => 150,    // Within same city
            'metro' => 200,    // Major cities
            'national' => 250  // Other cities
        ];

        $weightRate = 80;      // PKR per additional kg
        $codFeeRate = 0.02;    // 2% COD fee (from TCS docs)
        
        // Determine zone based on destination city
        $majorCities = ['karachi', 'lahore', 'islamabad', 'rawalpindi', 'faisalabad'];
        $originCity = strtolower(config('tcs.origin_city', 'karachi'));
        
        $cityKey = strtolower($destinationCity);
        
        if ($cityKey === $originCity) {
            $zone = 'local';
        } elseif (in_array($cityKey, $majorCities)) {
            $zone = 'metro';
        } else {
            $zone = 'national';
        }

        $baseRate = $baseRates[$zone];

        // Round weight up to nearest 0.5 kg (TCS standard)
        $roundedWeight = ceil(max($weight, 0.5) * 2) / 2;

        // Weight charge (base weight is 0.5kg included in base rate)
        $weightCharge = ($roundedWeight - 0.5) > 0 ? ($roundedWeight - 0.5) * $weightRate : 0;
        
        // COD fee (only for COD orders)
        $codFee = $codAmount * $codFeeRate;

        $total = $baseRate + $weightCharge + $codFee;

        Log::info('TCS Fallback Shipping Calculation', [
            'destination_city' => $destinationCity,
            'zone' => $zone,
            'weight_kg' => $roundedWeight,
            'base_rate' => $baseRate,
            'weight_charge' => $weightCharge,
            'cod_fee' => $codFee,
            'total_charges' => $total
        ]);

        return round(max($total, $baseRate)); // Minimum charge is base rate
    }

    /**
     * Alternative: Create a test booking to get actual charges (if you want real TCS rates)
     */
    private function getChargesViaTestBooking($originCity, $destinationCity, $weight, $codAmount)
    {
        try {
            $accessToken = $this->getAccessToken();
            if (!$accessToken) {
                return null;
            }

            // Create a minimal test booking payload
            $testPayload = [
                "accesstoken" => $accessToken,
                "consignmentno" => "",
                "shipperinfo" => [
                    "tcsaccount" => config('tcs.tcs_account', '04011K1'),
                    "shippername" => config('tcs.shipper_name', 'Test Company'),
                    "address1" => config('tcs.shipper_address', 'Test Address'),
                    "address2" => "",
                    "address3" => "",
                    "zip" => "75800",
                    "countrycode" => "PK",
                    "countryname" => "Pakistan",
                    "citycode" => $this->getCityCode($originCity),
                    "cityname" => $originCity,
                    "mobile" => "923451234567"
                ],
                "consigneeinfo" => [
                    "consigneecode" => "",
                    "firstname" => "Test",
                    "middlename" => "User",
                    "lastname" => "Calculation",
                    "address1" => "Test Address",
                    "address2" => "",
                    "address3" => "",
                    "zip" => "",
                    "countrycode" => "PK",
                    "countryname" => "Pakistan",
                    "citycode" => $this->getCityCode($destinationCity),
                    "cityname" => $destinationCity,
                    "email" => "test@example.com",
                    "areacode" => "",
                    "areaname" => "",
                    "blockcode" => "",
                    "blockname" => "",
                    "lat" => "",
                    "lng" => "",
                    "landmark" => "",
                    "mobile" => "923451234568",
                    "consigneecnic" => ""
                ],
                "vendorinfo" => [
                    "name" => config('tcs.shipper_name', 'Test Company'),
                    "address1" => config('tcs.shipper_address', 'Test Address'),
                    "address2" => "",
                    "address3" => "",
                    "citycode" => $this->getCityCode($originCity),
                    "cityname" => $originCity,
                    "mobile" => "923451234567"
                ],
                "shipmentinfo" => [
                    "costcentercode" => config('tcs.cost_center_code', 'Test-01'),
                    "referenceno" => "TEST-CALC-" . time(),
                    "contentdesc" => "Shipping Calculation Test",
                    "servicecode" => "O",
                    "parametertype" => "",
                    "shipmentdate" => now()->format('d/m/Y H:i:s'),
                    "shippingtype" => "",
                    "currency" => "PKR",
                    "codamount" => $codAmount,
                    "declaredvalue" => 0,
                    "insuredvalue" => 0,
                    "transactiontype" => "",
                    "dsflag" => "",
                    "carrierslug" => "",
                    "weightinkg" => floatval(max($weight, 0.5)),
                    "pieces" => 1,
                    "fragile" => false,
                    "remarks" => "Test booking for charge calculation",
                    "skus" => [
                        [
                            "description" => "Test Product",
                            "quantity" => 1,
                            "weight" => floatval(max($weight, 0.5)),
                            "uom" => "KG",
                            "unitprice" => 100,
                            "declaredvalue" => 0,
                            "insuredvalue" => 0,
                            "hscode" => ""
                        ]
                    ],
                    "piecedetail" => [
                        [
                            "length" => 10,
                            "width" => 10,
                            "height" => 10
                        ]
                    ],
                    "vas" => ""
                ]
            ];

            $response = Http::withHeaders([
                'accept' => '*/*',
                'Authorization' => 'Bearer ' . config('tcs.bearer_token'),
                'Content-Type' => 'application/json-patch+json',
            ])->timeout(30)
              ->post(config('tcs.ecom_url') . '/booking/create', $testPayload);

            if ($response->successful()) {
                $bookingData = $response->json();
                // You would need to check the actual response structure for charges
                // This might require additional API calls to get invoice details
                Log::info('Test booking response for charges', $bookingData);
            }

            return null; // Fallback since we can't easily extract charges

        } catch (\Throwable $th) {
            Log::error('Test booking for charges failed: ' . $th->getMessage());
            return null;
        }
    }

    /**
     * Get city code mapping
     */
    private function getCityCode($cityName)
    {
        $cityMap = [
            'islamabad' => 'ISB',
            'karachi' => 'KHI',
            'lahore' => 'LHE',
            'rawalpindi' => 'RWP',
            'faisalabad' => 'FSD',
            'multan' => 'MUX',
            'peshawar' => 'PSR',
            'quetta' => 'QTA',
            'hyderabad' => 'HYD',
            'sialkot' => 'SKT',
            'gujranwala' => 'GUJ'
        ];

        return $cityMap[strtolower($cityName)] ?? 'KHI';
    }

    /**
     * Calculate cart subtotal
     */
    private function calculateSubtotal($cart)
    {
        return $cart->sum(function ($item) {
            $price = $item->variation->sale_price ?? $item->product->saleprice ?? 0;
            return $price * $item->quantity;
        });
    }

    /**
     * Calculate total weight
     */
    private function calculateTotalWeight($cart)
    {
        return $cart->sum(function ($item) {
            $rawWeight = $item->variation->weight ?? $item->product->weight ?? 500;
            $unit = strtolower($item->variation->weight_unit ?? $item->product->weight_unit ?? 'g');
            $quantity = $item->quantity ?? 1;

            $weightKg = ($unit === 'g' || $unit === 'gram' || $unit === 'grams')
                ? $rawWeight / 1000
                : $rawWeight;

            return $weightKg * $quantity;
        });
    }

    public function store(ShippingRequest $request)
    {  
        try {
            $order = OrderService::store($request);
            return redirect(route('user-dashboard'))->with('message', 'Order placed successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    // Your existing getAccessToken and getBearerToken methods remain the same
    private function getBearerToken()
    {
        $token = config('tcs.bearer_token');
        if (!$token) {
            Log::error('TCS → Missing Bearer token in .env');
            return null;
        }
        return $token;
    }
    
    private function getAccessToken()
    {
        if ($token = Cache::get('tcs_access_token')) {
            return $token;
        }

        $bearer = $this->getBearerToken();
        if (!$bearer) return null;

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $bearer,
                'Accept' => 'application/json',
            ])->get(config('tcs.ecom_url') . '/authentication/token', [
                'username' => config('tcs.username'),
                'password' => config('tcs.password'),
            ]);

            if ($response->successful()) {
                $token = $response->json('accesstoken');
                if ($token) {
                    Cache::put('tcs_access_token', $token, now()->addHours(23));
                    return $token;
                }
            }
        } catch (\Exception $e) {
            Log::error('TCS → Exception while fetching access token: ' . $e->getMessage());
        }

        return null;
    }
}