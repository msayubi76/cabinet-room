<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PaymentService
{


    public static function store(Request $request)
    {
        DB::beginTransaction();
        $array = [];

        $cart = Cart::where('user_id', Auth::id())->get();
        foreach ( $cart as $cartitem ) :


            $data['user_id'] = $cartitem->user_id;
            $data['status'] = $cartitem->id;
            $data['method'] = $cartitem->id;


                $array[] = $data;


        endforeach;


        $payment = Payment::insert($array);
        DB::commit();
        return $payment;
    }


  }




