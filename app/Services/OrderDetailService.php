<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\OrderDetail;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderDetailService
{


    public static function store(Request $request)
    {
        DB::beginTransaction();


        $cart = Cart::where('user_id', Auth::id())->get();
        foreach ( $cart as $cartitem ) :


            $data['order_id'] = $cartitem->order_id;
            $data['payment_id'] = $cartitem->payment_id;
            $data['quantity'] = $cartitem->quantity;
            $data['price'] = $cartitem->price;

dd($data);




        endforeach;


        $orderdetail = OrderDetail::insert($data);
        DB::commit();
        return $orderdetail;
    }


  }




