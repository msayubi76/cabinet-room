<?php

namespace App\Http\Controllers;

use App\Models\BalanceSheet;
use App\Models\Transaction;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BalanceSheetController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('permission:order.add_payment',['only'=>['savePayment']]); 
        $this->middleware('auth');
    } 

    public function savePayment(Request $request)
    { 
        $this->validate($request,[
            'customer_id' => 'required|max:255',
            'paid_amount' => 'required|max:50', 
            'remarks' => 'required|max:50', 
            'payment_date' => 'required|date', 
        ]);

        try {
            DB::beginTransaction();
            $data = $request->except('_token', 'id');

            $transaction_id = decrypt($request->id);
            $customer_id = decrypt($request->customer_id);
            $paid_amount = $request->paid_amount;
            $remarks =  $request->remarks;

            $transaction = Transaction::find($transaction_id);
            $paid_amount = $transaction->paid_amount + $paid_amount;

            
            if( $paid_amount >= $transaction->total ):
                $payment_status = "paid";
            else: 
                $payment_status = "partial";
            endif;


           $transaction->update(['paid_amount' => $paid_amount, 'payment_status' =>$payment_status ]);
            $data['customer_id'] = $customer_id;
            $data['amount'] = $request->paid_amount;
            $data['transaction_id'] = $transaction_id; 
            $data['remarks'] = $remarks; 
            $data['payment_date'] = date('Y-m-d h:m:s', strtotime( $request->payment_date));
            BalanceSheet::create($data);
             
            DB::commit();
            return response()->json(
                ['status' => true, 
                'remaining_amount' => $transaction->total -  $transaction->paid_amount,  
            
            'message' => "Payment Saved"]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false,   'message' => $e->getMessage()]);
        } 
    }

    
    public function getCustomerPayments()
    {
        try {
            $title = "Payments";
            $type = "Payments List";
            
            $items = BalanceSheet::where('customer_id', Auth::user()->id)
            ->get()->unique('transaction_id');
          
            return view('customer/payments',compact('items', 'title', 'type'));
        } catch (\Throwable $th) {
            DB::rollback(); 
            return redirect('dashboard')->with('error', $th->getMessage()); 
        }
    }
    
    public function getCustomerPaymentDetail($id)
    {
        try {

            $transaction = Transaction::find(decrypt($id));
            $getTransactionsSelline = $transaction->getTransactionsSelline;

            if($transaction->type == 'product'):
                $currency_type = $getTransactionsSelline?
                ($getTransactionsSelline->getProduct?
                $getTransactionsSelline->getProduct->currency_type:"")
                :""; 
            else: 
                $currency_type = $getTransactionsSelline?
            ($getTransactionsSelline->getPart?
            $getTransactionsSelline->getPart->currency_type:"")
            :""; 
            endif;

             
          
            return view('customer/payment_detail',compact('transaction', 'currency_type'));
        } catch (\Throwable $th) {
            DB::rollback(); 
            return redirect('dashboard')->with('error', $th->getMessage()); 
        }
    }


}
