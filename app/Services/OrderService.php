<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderService
{


    public static function store(Request $request)
    {
        DB::beginTransaction();
        $array = [];

        $cart = Cart::where('user_id', Auth::id())->get();
        foreach ( $cart as $cartitem ) :


            $data['user_id'] = $cartitem->user_id;
            $data['payment_id'] = $cartitem->payment_id;
            $data['shipping_detail_id'] = $cartitem->shipping_detail_id;
            $data['order_status'] = $cartitem->order_status;
            $data['tax'] = $cartitem->tax;
            $data['delivery_fee'] = $cartitem->delivery_fee;
            $data['cancell_at'] = $cartitem->cancell_at;


                $array[] = $data;


        endforeach;


        $order = Order::insert($array);
        DB::commit();
        return $order;
    }


  }




