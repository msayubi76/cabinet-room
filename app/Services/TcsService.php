<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class TcsService
{
    private $baseUrl;
    private $ecomUrl;
    private $trackingUrl;
    private $username;
    private $password;
    private $bearerToken;

    public function __construct()
    {
        $this->baseUrl = config('tcs.base_url', 'https://devconnect.tcscourier.com');
        $this->ecomUrl = config('tcs.ecom_url', 'https://devconnect.tcscourier.com/ecom/index.html');
        $this->trackingUrl = config('tcs.tracking_url', 'https://devconnect.tcscourier.com/tracking/index.html');
        $this->username = config('tcs.username');
        $this->password = config('tcs.password');
        $this->bearerToken = config('tcs.bearer_token');
    }

    /**
     * Get access token from TCS API
     */
    private function getAccessToken()
    {
        $cachedToken = Cache::get('tcs_access_token');
        if ($cachedToken) {
            return $cachedToken;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->bearerToken,
                'accept' => '*/*',
            ])->get($this->baseUrl . '/ecom/api/authentication/token', [
                'username' => $this->username,
                'password' => $this->password,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $accessToken = $data['accesstoken'] ?? null;

                if (!$accessToken) {
                    return null;
                }

                // Use reasonable cache time regardless of API's long expiry
                $cacheMinutes = 60 * 23; // 23 hours - refresh daily
                Cache::put('tcs_access_token', $accessToken, now()->addMinutes($cacheMinutes));

                Log::info('TCS Token cached for ' . $cacheMinutes . ' minutes', [
                    'api_expiry' => $data['expiry'] ?? 'none',
                    'our_cache_expiry' => $cacheMinutes . ' minutes'
                ]);

                return $accessToken;
            }
            // ... error handling
        } catch (\Exception $e) {
            // ... error handling
            return null;
        }
    }

    /**
     * Create shipment in TCS system
     */
    public function createShipment($order)
    {
        try {
            // Get access token
            $accessToken = $this->getAccessToken();
            if (!$accessToken) {
                return [
                    'success' => false,
                    'error' => 'Failed to authenticate with TCS API'
                ];
            }
            dd($order);

            // Prepare shipment data
            $shipmentData = $this->prepareShipmentData($order);

            // Make API call to create shipment
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '/api/shipments', $shipmentData);
            if ($response->successful()) {
                $shipmentResponse = $response->json();

                return [
                    'consignee_name' => $order->shipping->full_name ?? $order->user->name,
                    'consignee_address' => $this->formatAddress($order->shipping),
                    'consignee_mobile' => $order->shipping->phone_number ?? $order->user->phone,
                    'consignee_email' => $order->user->email,
                    'consignee_city' => $order->shipping->city ?? '',
                    'consignee_country' => 'Pakistan',
                    'origin_city' => config('services.tcs.origin_city', 'Karachi'),
                    'destination_city' => $order->shipping->city ?? '',
                    'weight' => max($totalWeight, 0.1), // Minimum weight 0.1 kg
                    'pieces' => $order->orderDetails->count(),
                    'cod_amount' => $order->payment->payment_method === 'cod' ? $order->total_amount : 0,
                    'customer_reference' => $order->order_number,
                    'services' => $order->payment->payment_method === 'cod' ? ['COD'] : [],
                    'product_detail' => $productDetails,
                    'declared_value' => $order->total_amount,
                    'customer_cod_amount' => $order->payment->payment_method === 'cod' ? $order->total_amount : 0,
                ];
            } else {
                Log::error('TCS Shipment Creation Failed', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                    'order_id' => $order->id
                ]);

                return [
                    'success' => false,
                    'error' => 'Shipment creation failed: ' . $response->body()
                ];
            }
        } catch (\Exception $e) {
            Log::error('TCS Shipment Creation Exception', [
                'message' => $e->getMessage(),
                'order_id' => $order->id
            ]);

            return [
                'success' => false,
                'error' => 'Exception: ' . $e->getMessage()
            ];
        }
    }
    private function formatAddress($shipping)
    {
        if (!$shipping) return '';

        $addressParts = [
            $shipping->address_line1,
            $shipping->address_line2,
            $shipping->city,
            $shipping->state,
            $shipping->postal_code,
            $shipping->country
        ];

        return implode(', ', array_filter($addressParts));
    }

    /**
     * Prepare shipment data for TCS API
     */
    private function prepareShipmentData($order)
    {
        // You'll need to adjust this based on TCS API requirements and your order structure
        return [
            'consignee_name' => $order->customer_name,
            'consignee_address' => $order->shipping_address,
            'consignee_mobile' => $order->customer_phone,
            'consignee_email' => $order->customer_email,
            'origin_city' => $order->origin_city, // Your warehouse city
            'destination_city' => $order->shipping_city,
            'weight' => $order->weight ?? 1, // in kg
            'pieces' => $order->pieces ?? 1,
            'cod_amount' => $order->cod_amount ?? 0,
            'customer_reference' => $order->order_number,
            'services' => $order->is_cod ? ['COD'] : [],
            'product_detail' => $this->prepareProductDetails($order),
            // Add other required fields as per TCS API documentation
        ];
    }

    /**
     * Prepare product details for the shipment
     */
    private function prepareProductDetails($order)
    {
        $items = [];

        foreach ($order->orderDetails as $orderDetail) {
            $items[] = [
                'description' => $orderDetail->getTCSItemDescription(),
                'quantity' => $orderDetail->quantity,
                'value' => $orderDetail->getDeclaredValue(),
                'weight' => $orderDetail->getItemWeight(),
                'sku' => $orderDetail->products->sku ?? '',
            ];
        }

        return $items;
    }

    /**
     * Generate receipt URL
     */
    private function generateReceiptUrl($trackingNumber)
    {
        return $this->trackingUrl . '?tracking_number=' . $trackingNumber;
    }

    /**
     * Track shipment
     */
    public function trackShipment($trackingNumber)
    {
        try {
            $accessToken = $this->getAccessToken();
            if (!$accessToken) {
                return [
                    'success' => false,
                    'error' => 'Failed to authenticate with TCS API'
                ];
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->get($this->baseUrl . '/api/track/' . $trackingNumber);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'tracking_info' => $response->json()
                ];
            } else {
                return [
                    'success' => false,
                    'error' => 'Tracking failed: ' . $response->body()
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => 'Exception: ' . $e->getMessage()
            ];
        }
    }
}
