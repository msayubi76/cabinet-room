<?php

namespace App\Http\Controllers\Website;

use App\Events\SendEmailEvent;
use App\Http\Controllers\Controller;
use App\Models\JdmParts;
use App\Models\Product;
use App\Models\Quote;
use App\Models\Transaction;
use App\Models\TransactionSellLine;
use App\User;
use Carbon\Carbon; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class QuoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    }

    public function create($id)
    { 
        $product = Product::find(decrypt($id));
        return view('website.quote')->with('product', $product);
    }

    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $data = $request->except('_token');
            $type = null;
            $product_id = null;
            $part_id = null;
            if( $request->part_id ):
                $part_id = decrypt($request->part_id); 
                $product = JdmParts::find($part_id);
                $type = "part"; 
                $data['part_id'] = $part_id;
            endif;
            
        
            if( $request->product_id ):
                $product_id = decrypt($request->product_id); 
                $product = Product::find($product_id); 
                $type = "product";
                $data['product_id'] = $product_id;
            endif;
             
            if( $request->reserve_by_admin ):
                $user = User::find($request->customer_id);
                $customer_total_amount = $request->customer_product_price;
                $redirect = '/';
                $order_status = 'in_process';
            else:
                $user = Auth::user();
                $customer_total_amount = $product->price;
                $redirect = 'dashboard';
                $order_status = 'pending';
            endif;

            $email = $user?
                    ($user->email?$user->email:"test@gmail.com")
                    :"";

            $transaction = array();
            $transaction_selline = array();
            $transaction_date = Carbon::now();
           
            $payment_status = "None";

            $transaction['customer_id'] =  $user->id;
            $transaction['customer_name'] =  $user->name;
            $transaction['transaction_date'] =  $transaction_date->setTimezone($user->time_zone)->toDateTimeString();
            $transaction['order_status'] =  $order_status;
            $transaction['payment_status'] =  $payment_status;
            $transaction['total'] =  $product->price;
            $transaction['customer_total_amount'] =  $customer_total_amount;
            $transaction['sub_total'] =  $product->price;
            $transaction['type'] = $type;
            
            

            $transaction = Transaction::create($transaction);
          
            $transaction->update(['transaction_no' => sprintf('Or-%04d', $transaction->id) ]);


            $transaction_selline['transaction_id'] = $type;
            $transaction_selline['transaction_id'] = $transaction->id;
            $transaction_selline['product_id'] = $product_id;
            $transaction_selline['part_id'] = $part_id;
            
            $transaction_selline['sale_price'] = $product->price;
            $transaction_selline['actual_sale_price'] = $product->price;
            $transaction_selline['customer_sale_price'] = $customer_total_amount;
            $transaction_selline['type'] = $type;
           
            $transaction_selline = TransactionSellLine::create($transaction_selline);
          
            $data['transaction_id'] = $transaction->id;
 
 
            // $item =  Quote::create($data);
             
            $product->update(['status' => 1]);
           

            event(new SendEmailEvent( $email , env('ADMIN_EMAIL'), true, 'quote', $transaction));
            DB::commit();
           
            return  redirect($redirect)->with('success','Quote Created Successfully. Confirmation email has been sent to the email.');
        }catch (\Exception $e){
            DB::rollback();  
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

}
