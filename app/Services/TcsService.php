<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class TcsService
{
    private $username;
    private $password;
    private $bearerToken;

    public function __construct()
    {
        $this->username = config('tcs.username');
        $this->password = config('tcs.password');
        $this->bearerToken = config('tcs.bearer_token');
    }



    /**
     * Fallback shipping calculation when TCS API is unavailable
     */
    // private function calculateFallbackShipping($calculationData)
    // {
    //     $baseRate = 150; // Base rate in PKR
    //     $weightRate = 50; // PKR per kg
    //     $codFeeRate = 0.02; // 2% COD fee

    //     $weight = $calculationData['weight'] ?? 1;
    //     $codAmount = $calculationData['codAmount'] ?? 0;

    //     $weightCharge = $weight * $weightRate;
    //     $codFee = $codAmount * $codFeeRate;

    //     return $baseRate + $weightCharge + $codFee;
    // }

    private function getBearerToken()
{
    // Since you're using a fixed dev bearer token, just return it.
    $token = config('tcs.bearer_token');

    if (!$token) {
        Log::error('TCS → Missing Bearer token in .env');
        return null;
    }

    Log::info('TCS → Using static Bearer token from config.');
    return $token;
}

private function getAccessToken()
{
    if ($token = Cache::get('tcs_access_token')) {
        Log::info('TCS → Using cached ECOM access token');
        return $token;
    }

    $bearer = $this->getBearerToken();
    if (!$bearer) {
        Log::error('TCS → Missing Bearer token for ECOM authentication');
        return null;
    }

    $url = config('tcs.ecom_url') . '/authentication/token';

    Log::info('TCS → Requesting ECOM access token', [
        'url' => $url,
        'username' => config('tcs.username'),
        'password' => config('tcs.password'),
    ]);

    try {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $bearer,
            'Accept' => 'application/json',
        ])->get($url, [
            'username' => config('tcs.username'),
            'password' => config('tcs.password'),
        ]);

        Log::info('TCS → ECOM token response', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);
        if ($response->successful()) {
            $token = $response->json('accesstoken');
            if ($token) {
                Cache::put('tcs_access_token', $token, now()->addHours(23));
                Log::info('TCS → ECOM access token cached successfully');
                return $token;
            } else {
                Log::error('TCS → Access token missing in response', ['response' => $response->json()]);
            }
        } else {
            Log::error('TCS → Access token request failed', ['status' => $response->status()]);
        }
    } catch (\Exception $e) {
        Log::error('TCS → Exception while fetching access token', [
            'error' => $e->getMessage(),
        ]);
    }

    return null;
}


    // /**
    //  * Calculate shipping charges
    //  */
    // public function calculateShippingCharges($order)
    // {
    //     try {
    //         $accessToken = $this->getAccessToken();
    //         if (!$accessToken) {
    //             return [
    //                 'success' => false,
    //                 'error' => 'Failed to authenticate',
    //                 'shipping_charges' => 200 // Fallback charge
    //             ];
    //         }

    //         $totalWeight = 0;
    //         foreach ($order->orderDetails as $orderDetail) {
    //             $totalWeight += $orderDetail->getItemWeight() ?: 0.5;
    //         }

    //         $calculationData = [
    //             "originCityName" => "KARACHI",
    //             "destinationCityName" => strtoupper($order->shipping->city),
    //             "weight" => max($totalWeight/1000, 0.5),
    //             "noOfPieces" => $order->orderDetails->count(),
    //             "codAmount" => $order->payment->method === 'cod' ? floatval($order->payment->total_amount) : 0,
    //             "productDetails" => "General Goods",
    //             "serviceType" => $order->payment->method === 'cod' ? "COD" : "OBS"
    //         ];

    //         // Try different endpoints for shipping calculation
    //         $endpoints = [
    //             '/ShippingCalculator/CalculateCharges',
    //             '/Shipping/CalculateCharges',
    //             '/Ecom/CalculateCharges'
    //         ];

    //         foreach ($endpoints as $endpoint) {
    //             $response = Http::withHeaders([
    //                 'Authorization' => 'Bearer ' . $accessToken,
    //                 'Content-Type' => 'application/json',
    //             ])->timeout(30)
    //                 ->post(config('tcs.ecom_url') . $endpoint, $calculationData);

    //             if ($response->successful()) {
    //                 $chargeData = $response->json();
    //                 $shippingCharges = $chargeData['totalAmount'] ?? $chargeData['charges'] ?? $chargeData['amount'] ?? 200;

    //                 return [
    //                     'success' => true,
    //                     'shipping_charges' => floatval($shippingCharges),
    //                     'chargeable_weight' => $totalWeight,
    //                 ];
    //             }
    //         }

    //         // Fallback calculation
    //         return [
    //             'success' => false,
    //             'shipping_charges' => 200,
    //             'chargeable_weight' => $totalWeight,
    //             'error' => 'All calculation endpoints failed'
    //         ];
    //     } catch (\Exception $e) {
    //         return [
    //             'success' => false,
    //             'shipping_charges' => 200,
    //             'error' => 'Exception: ' . $e->getMessage()
    //         ];
    //     }
    // }
    public function calculateShippingCharges($order)
{
    try {
        // Get the destination city from shipping
        $destinationCity = $order->shipping->city ?? 'Karachi';
        $codAmount = $order->payment->method === 'cod' ? floatval($order->payment->total_amount) : 0;

        // Calculate total weight from order details
        $totalWeight = 0;
        foreach ($order->orderDetails as $orderDetail) {
            $totalWeight += $this->getItemWeightInKg($orderDetail);
        }

        // Use the same calculation as checkout
        $shippingCharges = $this->calculateFallbackShipping([
            'weight' => $totalWeight,
            'codAmount' => $codAmount,
            'destinationCity' => $destinationCity
        ]);

        return [
            'success' => true,
            'shipping_charges' => $shippingCharges,
            'chargeable_weight' => $totalWeight,
            'destination_city' => $destinationCity,
            'calculation_type' => 'fallback'
        ];

    } catch (\Exception $e) {
        Log::error('TCS Shipping Calculation Error: ' . $e->getMessage());
        
        // Emergency fallback
        $fallbackCharge = 250;
        return [
            'success' => false,
            'shipping_charges' => $fallbackCharge,
            'error' => 'Calculation failed, using fallback'
        ];
    }
}

/**
 * Get item weight in KG - consistent with checkout
 */
private function getItemWeightInKg($orderDetail)
{
    $rawWeight = $orderDetail->item_weight ?? $orderDetail->product->weight ?? 500;
    $unit = strtolower($orderDetail->weight_unit ?? $orderDetail->product->weight_unit ?? 'g');
    
    if ($unit === 'g' || $unit === 'gram') {
        return $rawWeight / 1000;
    } elseif ($unit === 'kg' || $unit === 'kilogram') {
        return $rawWeight;
    } else {
        return $rawWeight / 1000; // Default to grams
    }
}

/**
 * Fallback shipping calculator - consistent with checkout
 */
private function calculateFallbackShipping($calculationData)
{
    $baseRates = [
        'local' => 150,
        'metro' => 200, 
        'national' => 250
    ];

    $weightRate = 80;
    $codFeeRate = 0.02;
    
    $originCity = strtolower(config('tcs.origin_city', 'karachi'));
    $destCity = strtolower($calculationData['destinationCity'] ?? 'karachi');
    
    // Determine zone
    $zone = ($destCity === $originCity) ? 'local' : 
            (in_array($destCity, ['karachi', 'lahore', 'islamabad', 'rawalpindi']) ? 'metro' : 'national');

    $baseRate = $baseRates[$zone];
    $weight = max($calculationData['weight'] ?? 1, 0.5);
    $codAmount = $calculationData['codAmount'] ?? 0;

    $roundedWeight = ceil($weight * 2) / 2;
    $weightCharge = max(($roundedWeight - 0.5), 0) * $weightRate;
    $codFee = $codAmount * $codFeeRate;

    $total = $baseRate + $weightCharge + $codFee;

    return round($total);
}
    /**
     * Create shipment in TCS system with detailed debugging
     */
    /**
     * Create shipment in TCS system - CORRECT METHOD
     */
    public function createShipment($order)
{
    try {
        // Step 1: Get ECOM access token (you're already doing this correctly)
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return ['success' => false, 'error' => 'Authentication failed'];
        }

        // Step 2: Prepare shipment data
        $shipmentData = $this->prepareEcomShipmentData($order, $accessToken);
        $endpoint = config('tcs.ecom_url') . '/booking/create';
        // DEBUG: Check the exact data type and structure
        Log::info('TCS Payload Data Type', [
            'is_array' => is_array($shipmentData),
            'is_object' => is_object($shipmentData),
            'json_encoded' => json_encode($shipmentData),
            'first_few_keys' => array_keys($shipmentData)
        ]);

        // Step 3: Try with ECOM access token in QUERY PARAMETER (like Swagger)
        $response = Http::withOptions(['verify' => false])
            ->withHeaders([
                'accept' => '*/*',
            'Authorization' => 'Bearer ' . config('tcs.bearer_token'), // ADD THIS
            'Content-Type' => 'application/json-patch+json', // CHANGE THIS
            ])->timeout(60)
            ->post($endpoint, $shipmentData);

        Log::info('TCS Booking Create Response', [
            'status' => $response->status(),
            'response' => $response->body(),
        ]);
        $shipmentResponse = $response->json();
        if ($shipmentResponse['message']=='SUCCESS') {
                $consignmentNumber = $shipmentResponse['consignmentNo'] ?? null;
                $traceid = $shipmentResponse['traceid'] ?? null;

                if ($consignmentNumber) {
                    $order->update([
                        'tcs_tracking_number' => $traceid,
                        'tcs_consignment_number' => $consignmentNumber,
                        'tcs_receipt_url' => $this->generateTrackingUrl($consignmentNumber),
                        'tcs_status' => 'created',
                    ]);

                    return [
                        'success' => true,
                        'tracking_number' => $traceid,
                        'consignment_number' => $consignmentNumber,
                    ];
                }
          
        }

        return [
            'success' => false,
            'error' => 'API Error: ' . $response->status() . ' - ' . $response->body(),
        ];

    } catch (\Exception $e) {
        Log::error('TCS Shipment Creation Exception', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return ['success' => false, 'error' => 'Exception: ' . $e->getMessage()];
    }
}
    
    /**
     * Get shipment label/receipt from TCS
     */
    private function getShipmentLabel($consignmentNumber, $accessToken = null)
    {
        try {

            if (!$accessToken) {
                $accessToken = $this->getAccessToken();
            }
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])
                ->timeout(30)
                ->get( config('tcs.ecom_url'). '/Consignment/' . $consignmentNumber . '/label');
            if ($response->successful()) {
                // TCS usually returns PDF or image data for label
                $contentType = $response->header('Content-Type');

                if (str_contains($contentType, 'pdf')) {
                    // Save PDF file
                    $fileName = 'tcs_label_' . $consignmentNumber . '.pdf';
                    $filePath = storage_path('app/public/tcs_labels/' . $fileName);

                    // Ensure directory exists
                    if (!file_exists(dirname($filePath))) {
                        mkdir(dirname($filePath), 0755, true);
                    }

                    file_put_contents($filePath, $response->body());

                    return [
                        'success' => true,
                        'label_url' => url('/storage/tcs_labels/' . $fileName),
                        'label_data' => base64_encode($response->body())
                    ];
                } else {
                    // Handle other response types
                    return [
                        'success' => true,
                        'label_url' => $this->generateTrackingUrl($consignmentNumber),
                        'label_data' => $response->body()
                    ];
                }
            }

            return [
                'success' => false,
                'error' => 'Failed to get label: ' . $response->body()
            ];
        } catch (\Exception $e) {
            Log::error('TCS Label Fetch Exception', [
                'consignment' => $consignmentNumber,
                'message' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => 'Label exception: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Prepare data for TCS E-Commerce API
     */
    /**
     * Prepare data for TCS E-Commerce API - CORRECT FORMAT
     */
    private function prepareEcomShipmentData($order, $accessToken)
{
    $shipping = $order->shipping;
    $isCod = $order->payment->method === 'cod';

    $totalWeight = 0;
    foreach ($order->orderDetails as $orderDetail) {
        $totalWeight += $orderDetail->item_weight ?: 0.5;
    }

    // Build SKUs array - FIXED weight format
    $skus = [];
    foreach ($order->orderDetails as $orderDetail) {
        $skus[] = [
            "description" => $orderDetail->product_id ?? 'Product',
            "quantity" => (int)$orderDetail->quantity,
            "weight" =>  $orderDetail->item_weight?floatval($orderDetail->item_weight/1000):0.5, // Ensure float
            "uom" => "KG",
            "unitprice" => floatval($orderDetail->price),
            "declaredvalue" => 0, // Use 0 instead of null
            "insuredvalue" => 0,  // Use 0 instead of null
            "hscode" => "" // Add required field
        ];
    }
  // FIX: Format mobile numbers exactly like Swagger
  $shipperMobile = "923451234567"; // Exactly like Swagger: 03451234567 -> 923451234567
  $consigneeMobile = $this->formatMobileNumberExactly($shipping->phone_number);
  $vendorMobile = "923451234567"; // Same as shipper

    $payload = [
        "accesstoken" => $accessToken,  // ADD THIS - CRITICAL!
        "consignmentno" => "",
        "shipperinfo" => [
            "tcsaccount" => config('tcs.tcs_account', '04011K1'),
            "shippername" => config('tcs.shipper_name', 'Your Company'),
            "address1" => config('tcs.shipper_address', 'Your Address'),
            "address2" => "",
            "address3" => "",
            "zip" => "75800",
            "countrycode" => "PK",
            "countryname" => "Pakistan",
            "citycode" => "KHI",
            "cityname" => "Karachi",
            "mobile" => $shipperMobile
        ],
        "consigneeinfo" => [
            "consigneecode" => "",
            "firstname" => $shipping->first_name,
            "middlename" => "",
            "lastname" => $shipping->last_name,
            "address1" => $shipping->address,
            "address2" => "",
            "address3" => "",
            "zip" => "",
            "countrycode" => "PK",
            "countryname" => "Pakistan",
            "citycode" => $this->getCityCode($shipping->city),
            "cityname" => $shipping->city,
            "email" => $shipping->email ?? $order->user->email,
            "areacode" => "",
            "areaname" => "",
            "blockcode" => "",
            "blockname" => "",
            "lat" => "",
            "lng" => "", // FIXED: was "ing"
            "landmark" => "",
            "mobile" => $consigneeMobile, // Use formatted mobile

            "consigneecnic" => "" // ADDED: required field
        ],
        // ADDED: vendorinfo section (required)
        "vendorinfo" => [
            "name" => config('tcs.shipper_name', 'Your Company'),
            "address1" => config('tcs.shipper_address', 'Your Address'),
            "address2" => "",
            "address3" => "",
            "citycode" => "KHI",
            "cityname" => "Karachi",
            "mobile" => $vendorMobile // Use formatted number
        ],
        "shipmentinfo" => [
            "costcentercode" => config('tcs.cost_center_code', 'Test-01'),
            "referenceno" => "ORD-" . $order->id,
            "contentdesc" => $this->getProductDetails($order),
            "servicecode" => "O", // Use "O" for testing
            "parametertype" => "",
            "shipmentdate" => now()->format('d/m/Y H:i:s'),
            "shippingtype" => "",
            "currency" => "PKR",
            "codamount" => $isCod ? (float) $order->payment->total_amount : 0,
            "declaredvalue" => 0, // Use 0 instead of null
            "insuredvalue" => 0,  // Use 0 instead of null
            "transactiontype" => "",
            "dsflag" => "",
            "carrierslug" => "",
            "weightinkg" => floatval(max($totalWeight/1000, 0.5)), // Ensure float
            "pieces" => (int)$order->orderDetails->count(),
            "fragile" => false,
            "remarks" => "E-Commerce Order",
            "skus" => $skus,
            // ADDED: piecedetail section (required)
            "piecedetail" => [
                [
                    "length" => 10,
                    "width" => 10,
                    "height" => 10
                ]
            ],
            "vas" => "" // ADDED: required field
        ]
    ];

    // Log the payload for debugging
    Log::info('TCS Final Payload Structure', [
        'has_vendorinfo' => isset($payload['vendorinfo']),
        'has_piecedetail' => isset($payload['shipmentinfo']['piecedetail']),
        'consignee_has_cnic' => isset($payload['consigneeinfo']['consigneecnic']),
        'weight_format' => gettype($payload['shipmentinfo']['weightinkg'])
    ]);

    return $payload;
}
private function formatMobileNumberExactly($phone)
{
    // For testing, use the exact same number as Swagger
    // return "923451234567"; // 03451234567 with country code
    
    // If you want to format dynamically:
    $clean = preg_replace('/[^0-9]/', '', $phone);
    if (strlen($clean) === 10) return '92' . $clean;
    if (strlen($clean) === 11 && str_starts_with($clean, '0')) return '92' . substr($clean, 1);
    return $clean;
}
    /**
     * Get city code - you'll need to map city names to TCS city codes
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

        return $cityMap[strtolower($cityName)] ?? 'ISB'; // Default to Islamabad
    }

    private function getProductDetails($order)
    {
        log::info('getProductDetails ');
        log::info($order);

        $products = [];
        foreach ($order->orderDetails as $orderDetail) {
            $products[] = $orderDetail->product_id . ' (Qty: ' . $orderDetail->quantity . ')';
        }
        return implode(', ', $products);
    }

    /**
     * Format address for TCS API
     */
    private function formatAddress($shipping)
    {
        log::info('formatAddress ');
        $addressParts = [
            $shipping->address_line_1,
            $shipping->address_line_2,
            $shipping->city,
            $shipping->state,
            $shipping->country,
            $shipping->postal_code
        ];

        return implode(', ', array_filter($addressParts));
    }

    /**
     * Generate tracking URL
     */
    private function generateTrackingUrl($consignmentNumber)
    {
        return 'https://devconnect.tcscourier.com/tracking/index.html?cn=' . $consignmentNumber;
    }

    /**
     * Track shipment using E-Commerce API
     */
    /**
 * Track shipment using E-Commerce API
 */
public function trackShipment($consignmentNumber)
{
    Log::info('TCS → Tracking consignment', ['consignment' => $consignmentNumber]);

    try {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return ['success' => false, 'error' => 'Authentication failed'];
        }

        $url = rtrim(config('tcs.ecom_url'), '/') . "/Consignment/{$consignmentNumber}/track";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Accept' => 'application/json',
        ])->timeout(30)->get($url);

        Log::info('TCS → Track Response', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        if ($response->successful()) {
            return [
                'success' => true,
                'data' => $response->json(),
            ];
        }

        return [
            'success' => false,
            'error' => 'Tracking failed: ' . $response->body(),
        ];
    } catch (\Exception $e) {
        Log::error('TCS → Track Exception', ['message' => $e->getMessage()]);
        return ['success' => false, 'error' => 'Exception: ' . $e->getMessage()];
    }
}


    /**
 * Download Shipment Receipt (CN Print)
 */
public function downloadShipmentLabel($consignmentNumber)
{
    try {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return ['success' => false, 'error' => 'Authentication failed'];
        }

        $url =  config('tcs.ecom_url') . '/print/label';

        $payload = [
            'consignmentno' => $consignmentNumber,
            'shipperdetail' => 'true',
            'accesstoken' => $accessToken,
        ];

        Log::info('TCS CN Print Request', [
            'url' => $url,
            'payload' => $payload
        ]);

        $response = Http::withHeaders(['Accept' => 'application/json'])
            ->get($url, $payload);

        if ($response->successful() && str_contains($response->header('Content-Type'), 'pdf')) {
            // Save the file locally
            $fileName = "tcs_receipt_{$consignmentNumber}.pdf";
            $filePath = storage_path("app/public/tcs_receipts/{$fileName}");

            if (!file_exists(dirname($filePath))) {
                mkdir(dirname($filePath), 0755, true);
            }

            file_put_contents($filePath, $response->body());

            return [
                'success' => true,
                'file_url' => url("/storage/tcs_receipts/{$fileName}")
            ];
        }

        Log::error('TCS CN Print Failed', [
            'status' => $response->status(),
            'body' => $response->body()
        ]);

        return [
            'success' => false,
            'error' => 'Failed to generate label: ' . $response->body()
        ];
    } catch (\Exception $e) {
        Log::error('TCS CN Print Exception', ['message' => $e->getMessage()]);
        return ['success' => false, 'error' => $e->getMessage()];
    }
}
// $receipt = $tcs->downloadShipmentReceipt($result['consignment_number']);

}
