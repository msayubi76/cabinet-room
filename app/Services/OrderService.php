<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\ShippingDetails;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ShppingRequest;
use App\Models\Variation;
use App\Traits\FileUploadTrait;

use App\Models\Category;
use App\Models\BillingDetails;
use App\Services\OrderService;
use App\Services\BillingService;
use App\Services\PaymentService;
use App\Http\Controllers\Controller;
use App\Services\OrderDetailService;

use App\Http\Requests\ShippingRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class OrderService
{
    public static function store(Request $request)
{
    DB::beginTransaction();
    $user = auth()->user();

    $shipping_detail = ShippingService::store($request);
    $payment = Payment::create(['user_id' => $user->id, 'amount' => 0, 'method' => $request->payment_method]);

    $OrderData['shipping_detail_id'] = $shipping_detail->id;
    $OrderData['payment_id'] = $payment->id;
    $OrderData['user_id'] = $user->id;
    $OrderData['order_status'] = 'pending';
    $OrderData['delivery_fee'] = NULL;
    $OrderData['cancel_at'] = NULL;
    
    if ($request->hasFile('payment_receipt') && $request->file('payment_receipt')) {
        $image_name = FileUploadTrait::fileUpload($request->payment_receipt, 'receipts');
        $OrderData['order_receipt'] = url('/storage/receipts/' . $image_name);
    } else {
        $OrderData['order_receipt'] = null;
    }
    
    $order = Order::create($OrderData);
    $amount = 0;
    $OrderDetailData = [];
    $cartItems = $user->cartItems;
        // $cities = config('constant.cities');

        // $filteredCity = array_filter($cities, function ($city) use ($shipping_detail) {
        //     return $city['name'] === $shipping_detail->city;
        // });
        // $foundCity = reset($filteredCity);
        // $city_charges = $foundCity['charges'];
    $city_charges = 0;

    foreach ($cartItems as $item) :
        $product = $item->product;
        $variation_id = $item->variation_id;
        $variation = Variation::find($variation_id);
        $quantity = $item->quantity;

        // Calculate sale price
        if ($variation) :
            $variation->update(['stock' => $variation->stock - $quantity]);
            $sale_price = $variation->sale_price * $quantity;
        else :
            $sale_price = $product->saleprice * $quantity;
        endif;

        $amount += round($sale_price, 4);
        $product->update(['stock' => $product->stock - $quantity]);
        // If variation exists and has its own dimensions, use them, otherwise use product dimensions
        if ($variation && !empty($variation)) {
            Log::info('variation');
            Log::info($variation);
            // Assuming you add dimension fields to variations table
            $itemWeight = $variation->weight;
            $dimensions = [
                'length' => $variation->length,
                'width' => $variation->width,
                'height' => $variation->height,
            ];
            $description = $variation->natcs_product_descriptionme;
        } else {
            $itemWeight = $product->weight;
            $dimensions = [
                'length' => $product->length,
                'width' => $product->width,
                'height' => $product->height,
            ];
            $description = $product->tcs_product_description;
        }

        $orderDetailItem = [
            'product_id' => $product->id, 
            'quantity' => $quantity, 
            'price' => $sale_price, 
            'order_id' => $order->id,  
            'variation_id' => $variation_id,
            // TCS-related fields
            'item_weight' => $itemWeight,
            'item_length' => $dimensions['length'] ?? 0,
            'item_width' => $dimensions['width'] ?? 0,
            'item_height' => $dimensions['height'] ?? 0,
            'tcs_item_description' => $description,
            'declared_value' => $sale_price,
        ];

        $OrderDetailData[] = $orderDetailItem;

    endforeach;
    $total_amount = $amount + round($city_charges, 4);
    $subtotal = $request->subtotal;
    $shippingCharges = $request->shipping_charges;
    $grandTotal = $request->grand_total;
    if ($request->payment_method == 'online_transfer'):
        $payment->update([
            'payment' => $grandTotal, 
            'remaining_amount' => 0, 
            'status' => 'paid', 
            'shipping_charges' => $shippingCharges, 
            'total_amount' => $grandTotal
        ]);
    else:
        $payment->update([
            'payment' => $grandTotal, 
            'remaining_amount' => $grandTotal, 
            'shipping_charges' => $shippingCharges, 
            'total_amount' => $grandTotal
        ]);
    endif;

    // Insert all order details at once
    OrderDetail::insert($OrderDetailData);

    $user->cartItems()->delete();
    DB::commit();
    return $order;
}
}
