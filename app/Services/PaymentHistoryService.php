<?php

namespace App\Services;

use App\Models\Order;

use App\Models\Payment;



use Illuminate\Http\Request;


use App\Models\PaymentHistory;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PaymentRequest;
use Symfony\Component\Mailer\Transport\Dsn;
use App\Http\Requests\PaymentHistoryRequest;

class PaymentHistoryService
{
    public static function store(PaymentRequest $request, Order $order)
    {

        DB::beginTransaction();

        $data = $request->validated();

      $payment_History = PaymentHistory::create($data);


      $payment= $order->payment;
      $amount= $order->payment->remaining_amount - $request->amount;

      $payment->update(['remaining_amount'=> $amount]);

        DB::commit();
        $response = ['status' => true, 'message' => 'Payment updated successfully.'];

        return $response;

    }
}
