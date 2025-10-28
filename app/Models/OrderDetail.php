<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price','variation_id',
         // TCS fields
         'item_weight',
         'item_length',
         'item_width', 
         'item_height',
         'tcs_item_description',
         'declared_value',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
    public function variation(): BelongsTo
    {
        return $this->belongsTo(Variation::class);
    }

     /**
     * Get item description for TCS
     */
    public function getTCSItemDescription()
    {
        return $this->tcs_item_description ?? $this->products->name;
    }

    /**
     * Get item weight for TCS (uses product weight if not set)
     */
    public function getItemWeight()
    {
        if ($this->item_weight) {
            return $this->item_weight;
        }
        
        return $this->products->getWeightInKg() * $this->quantity;
    }

    /**
     * Get declared value for TCS
     */
    public function getDeclaredValue()
    {
        return $this->declared_value ?? ($this->price * $this->quantity);
    }
}
5. Updated TCSService Methods
Update your TCSService to use these new fields:

php
// In your TCSService class, update the prepareShipmentData method:

/**
 * Prepare shipment data for TCS API
 */
private function prepareShipmentData($order)
{
    $productDetails = $this->prepareProductDetails($order);
    $totalWeight = collect($productDetails)->sum('weight');
    
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
 * Format shipping address
 */
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
