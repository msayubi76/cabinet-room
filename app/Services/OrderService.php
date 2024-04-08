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

class OrderService
{
    public static function store(Request $request)
    {
        DB::beginTransaction();
        $user = auth()->user();


        $shipping_detail = ShippingService::store($request);

        $payment = Payment::create(['user_id' => $user->id, 'amount' => 0, 'method' => 'cash_on_delivery']);

        $OrderData['shipping_detail_id'] = $shipping_detail->id;

        $OrderData['payment_id'] = $payment->id;

        $OrderData['user_id'] = $user->id;

        $OrderData['order_status'] = 'pending';
        $OrderData['delivery_fee'] = NULL;
        $OrderData['cancel_at'] = NULL;

        $order = Order::create($OrderData);

        $amount = 0;
        $shippingTotal = 0;
        $OrderDetailData = [];
        $cartItems = $user->cartItems;

        // $cities = config('constant.cities');

        // $filteredCity = array_filter($cities, function ($city) use ($shipping_detail) {
        //     return $city['name'] === $shipping_detail->city;
        // });
        // $foundCity = reset($filteredCity);
        // $city_charges = $foundCity['charges'];
        $city_charges = 0;

        $total_quantity = 0;


        foreach ($cartItems as  $item) :

            $product = $item->product;
            $variation_id = $item->variation_id;

            $variation = Variation::find($variation_id);
            $quantity = $item->quantity;

            $sale_price = $product->saleprice;
            $shipping_charges = $city_charges;

            // inventory


           
            if ($variation) :
                $variation->update(['stock' => $variation->stock - $quantity]);
                $sale_price = $variation->sale_price * $quantity;
            else :
                $sale_price = $sale_price * $quantity;
            endif;

            $amount =  $amount + round($sale_price, 4);
            $total_amount = $amount + round($shipping_charges, 4);

            $product->update(['stock' => $product->stock - $quantity]);
           


            $OrderDetailData[] = ['product_id' => $product->id, 'quantity' => $quantity, 'price' => $sale_price, 'order_id' => $order->id,  'variation_id' => $variation_id];
          
        endforeach;
        $payment->update(['payment' => $amount, 'remaining_amount' => $amount, 'shipping_charges' => $shipping_charges, 'total_amount' => $total_amount]);
        OrderDetail::insert($OrderDetailData);

        $user->cartItems()->delete();
        DB::commit();
        return $order;
    }
}
