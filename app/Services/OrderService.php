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

class OrderService
{

    public function placeOrder($request)
    {
        DB::beginTransaction();



        DB::commit();
    }


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
        $OrderDetailData = [];
        foreach ($user->cartItems as  $item) :

            $product = $item->product;

            $quantity = $item->quantity;

            $saleprice = (float) $product->saleprice;

            $price = $saleprice * $quantity;

            $amount =  $amount + round($price, 4);


            $OrderDetailData[] = ['product_id' => $product->id, 'quantity' => $quantity, 'price' => $saleprice, 'order_id' => $order->id];
        endforeach;

        $payment->update(['payment' => $amount]);

        OrderDetail::insert($OrderDetailData);

        $user->cartItems()->delete();
        DB::commit();
        return $order;
    }
}
