<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Http\Requests\PaymentRequest;
use App\Services\PaymentHistoryService;
use App\Http\Requests\PaymentHistoryRequest;

class PaymentHistoryController extends Controller
{


     public function store(PaymentRequest $request, Order $order)
    {
        try {

            $payment_history = PaymentHistoryService::store($request,$order);

            return $payment_history;
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
      }

    }
    public function paymentHistory($order)
    {
        try {

            $payment_history = PaymentHistory::where('order_id',$order)->get();
            // dd($payment_history);

            return view('admin.orders.paymentHistory',compact('payment_history'));


        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
      }

    }
}
