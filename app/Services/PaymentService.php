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


        $cart = Cart::where('user_id', Auth::id())->get();
        foreach ( $cart as $cartitem ) :


            $data['user_id'] = $cartitem->user_id;
            $data['status'] = $cartitem->status;
            $data['method'] = $cartitem->method;






        endforeach;


        $payment = Payment::insert($data);

        DB::commit();
        return $payment;

    }


  }




