<?php

namespace App\Http\Requests;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        $order_id = $request->route('order');


        $amount= $order_id->payment->remaining_amount;


        $rules =  [
            'user_id'=> ['required'],
            'order_id' => ['required'],

            'amount'=> ['required'],
              'comment'=> ['nullable'],
              'created_by'=> ['nullable'],
              'updated_by'=> ['nullable'],
              'deleted_by'=> ['nullable'],

        ];

// if(  $rules['amount'] <=  $order_id->payment->remaining_amount ){

//     $rules['amount'] = ['required'];
// }

        return $rules;
    }
}
