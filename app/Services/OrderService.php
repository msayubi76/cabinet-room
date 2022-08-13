<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\ShippingDetails;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderService
{


    public static function store(Request $request)
    {
        DB::beginTransaction();


        $cart = Cart::where('user_id', Auth::id())->get();
        foreach ( $cart as $cartitem ) :


            $data['user_id'] = $cartitem->user_id;

            $data['payment_id'] =   Payment::where('user_id', Auth::id())->get();
            $data['shipping_detail_id'] = ShippingDetails::where('user_id', Auth::id())->get();
            $data['order_status'] = $cartitem->order_status;
            $data['tax'] = $cartitem->tax;
            $data['delivery_fee'] = $cartitem->delivery_fee;
            $data['cancell_at'] = $cartitem->cancell_at;


dd($data);


        endforeach;


        $order = Order::insert($data);
        DB::commit();
        return $order;
    }


  }




