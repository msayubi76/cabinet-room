<?php

namespace App\Http\Controllers;

use App\Events\SendEmailEvent;
use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use App\Models\Quote;
use App\Models\SubCategory;
use App\Models\Transaction;
use App\Models\TransactionSellLine;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Testing\MimeType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
     use FileUploadTrait;
    public function __construct()
    {
        $this->middleware('auth');
      
        $this->middleware(['role_or_permission:Customer|Super Admin|order.view_documents'], ['only'=>['getOrderDetail']]);
          
        $this->middleware('permission:order.accept',['only'=>['updatePrice']]);
        $this->middleware('permission:order.reject',['only'=>['rejectOrder']]);
        $this->middleware('permission:order.mark_as_complete',['only'=>['completetOrder']]);
        $this->middleware('permission:order.add_shipping_detail',['only'=>['addShippingDetail']]);

        $this->middleware('permission:order.in_process_list', ['only' => ['getInProcessOrderForAdmin']]);
        $this->middleware('permission:order.quotation_list', ['only' => ['getQuotationOrderForAdmin']]);
        $this->middleware('permission:order.completed_list', ['only' => ['getCompletedOrderForAdmin']]);
        $this->middleware(['permission:order.rejected_list'], ['only' => ['getRejectedForAdmin']]);
    } 
    public function index()
    {
        
    }
  
    public function getOrderDetail($id)
    {
        $id=decrypt($id);
       
        $transaction = Transaction::find($id);
        $product_name = null;
        if($transaction->type == 'product'):
            $product = $transaction->getTransactionsSelline?($transaction->getTransactionsSelline->getProduct?$transaction->getTransactionsSelline->getProduct:''):'';
             $category = $product?($product->getCategory ? $product->getCategory->name:"") :"";
             $sub_category = $product?($product->getSubCategory ? $product->getSubCategory->name:"") :"";
             $product_name = $category.','.$sub_category;
        else: 
            $product = $transaction->getTransactionsSelline?($transaction->getTransactionsSelline->getPart?$transaction->getTransactionsSelline->getPart:''):'';
            $product_name = $product->name;
        endif; 
        $files =  Media::where('transaction_id', $id)->where('model_type', 'App\Models\Transaction')->get();
        $type = $transaction->type; 
        if ($transaction instanceof \Exception) {
            return redirect()->back()->with('error',$transaction->getMessage());
        }
        if ($transaction) { 
            return view('order.order_detail', compact('transaction','product', 'files', 'type', 'product_name'));
        }
        return redirect()->back()->with('error', "Order not exist"); 
    }

     
    public function getQuotationOrderForAdmin(   )
    {
        try {

            $title = "Quotations";
            $type = "quotation_orders";
              
            $items = Transaction::where('order_status','=' ,'pending') 
            ->orderBy('id', 'desc')
            ->get(); 
 
 
            return view('order/orders',compact('items', 'title', 'type'));
  
        } catch (\Throwable $th) {
            DB::rollback(); 
            return redirect('dashboard')->with('error', $th->getMessage()); 
        }
    }

    public function getInProcessOrderForAdmin()
    {
        try {

            $title = "In Process";
            $type = "in_process";

            

            $items = Transaction::where('order_status','=' ,"in_process")
            ->orderBy('id', 'desc')
            ->get(); 
            return view('order/orders',compact('items', 'title', 'type'));
  
        } catch (\Throwable $th) {
            DB::rollback(); 
            return redirect('dashboard')->with('error', $th->getMessage()); 
        }
    }
    
    public function getCompletedOrderForAdmin()
    {
        try {

            $title = "Complete Order";
            $type = "complete_order";

            $items = Transaction::where('order_status','=' ,"completed")
            ->orderBy('id', 'desc')
            ->get(); 
            return view('order/orders',compact('items', 'title', 'type'));
  
        } catch (\Throwable $th) {
            DB::rollback(); 
            return redirect('dashboard')->with('error', $th->getMessage()); 
        }
    }
    
    public function getRejectedForAdmin()
    {
        try {

            $title = "Rejected Order";
            $type = "rejected_order";

            $items = Transaction::where('order_status','=' ,"rejected")
            ->orderBy('id', 'desc')
            ->get(); 
            return view('order/orders',compact('items', 'title', 'type'));
  
        } catch (\Throwable $th) {
            DB::rollback(); 
            return redirect('dashboard')->with('error', $th->getMessage()); 
        }
    }

    public function getQuotationOrderForCustomer()
    {
        try {

            $title = "Quotations";
            $type = "quotation_orders";

            $items = Transaction::where('order_status','=' ,'pending')
            ->where('customer_id','=' ,Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get(); 
            return view('order/orders',compact('items', 'title', 'type'));
  
        } catch (\Throwable $th) {
            DB::rollback(); 
            return redirect('dashboard')->with('error', $th->getMessage()); 
        }
    }

    public function getInProcessOrderForCustomer()
    {
        try {
            $title = "In Process";
            $type = "in_process";

            $items = Transaction::where('order_status','=' ,"in_process")
            ->where('customer_id','=' ,Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();

            return view('order/orders',compact('items', 'title', 'type'));
  
        } catch (\Throwable $th) {
            DB::rollback(); 
            return redirect('dashboard')->with('error', $th->getMessage()); 
        }
    }

    public function getCompletedOrderForCustomer()
    {
        try {
            $title = "Complete Order";
            $type = "complete_order";

            $items = Transaction::where('order_status','=' ,"completed")
            ->where('customer_id','=' ,Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();

            return view('order/orders',compact('items', 'title', 'type'));
  
        } catch (\Throwable $th) {
            DB::rollback(); 
            return redirect('dashboard')->with('error', $th->getMessage()); 
        }
    }

    public function updatePrice(Request $request)
    {
        $this->validate($request,[
            'actual_sale_price'=>'required|min:0|numeric', 
            'customer_sale_price'=>'nullable|min:0|numeric', 
        ]);

        try{

            DB::beginTransaction();
            $data= $request->except('id');

            $id = decrypt($request->id);
 
            $transactionselline = TransactionSellLine::find($id);

            $transaction = $transactionselline->getTransaction;

            // dd($transaction);

  
            if(!$request->customer_sale_price):
                $data['customer_sale_price'] = $request->actual_sale_price;
            endif;

            $transactionselline->update($data);
            $transactionselline = TransactionSellLine::find($id);
            $transaction->update(
                ['total'=>$request->actual_sale_price,
                'customer_total_amount'=> $data['customer_sale_price'], 
                'order_status'=>"in_process"
                ]);

            $transaction = $transactionselline->getTransaction;

            $email = $transaction->getCustomer?$transaction->getCustomer->email:'';

            event(new SendEmailEvent( $email, env('ADMIN_EMAIL'), false, 'order_accepted', $transaction));

            DB::commit(); 
            
            return response()->json(['status' => true, 'success' =>true, 'message' =>"Order Accepted", 'price' => $transaction->total]);
        }catch (\Exception $e){
            DB::rollback();
            return response()->json(['status' => false, 'success' =>false, 'message' => $e->getMessage()]);
        }
    }
    public function rejectOrder( $id)
    { 
        try{ 
            DB::beginTransaction();
            $id = decrypt($id);
            $transaction = Transaction::find($id);
            $transaction->update(['order_status'=>"rejected"]);
            DB::commit();  
            return response()->json(['status' => true, 'success' =>true, 'message' =>"Order Rjected", ]);
        }catch (\Exception $e){
            DB::rollback();
            return response()->json(['status' => false, 'success' =>false, 'message' => $e->getMessage()]);
        }
    }
    
    public function completetOrder( $id)
    { 
        try{ 
            DB::beginTransaction();
            $id = decrypt($id);
            $transaction = Transaction::find($id);

            if($transaction->type == 'product'):
                $product = $transaction->getTransactionsSelline?
                ($transaction->getTransactionsSelline->getProduct?
                $transaction->getTransactionsSelline->getProduct:''
                ):'';
            else: 
                $product = $transaction->getTransactionsSelline?
                ($transaction->getTransactionsSelline->getPart?
                $transaction->getTransactionsSelline->getPart:''
                ):'';
            
            endif;
          
            
                
            if( $product ):
                $product->update(['status'=>2]);
                $transaction->update(['order_status'=>"completed"]);
            else:
                return response()->json(['status' => false, 'success' =>true, 'message' =>"Prodcut not exist", ]);
            endif;
 
            DB::commit();  
            $email = $transaction->getCustomer?$transaction->getCustomer->email:'';
            event(new SendEmailEvent(  $email , env('ADMIN_EMAIL'), false, 'shipped', $transaction));
            
            return response()->json(['status' => true, 'success' =>true, 'message' =>"Order Completed", ]);
        }catch (\Exception $e){
            DB::rollback();
            return response()->json(['status' => false, 'success' =>false, 'message' => $e->getMessage()]);
        }
    }
    
    public function addShippingDetail(  Request $request )
    { 
        $this->validate($request,[
            'shipping_detail'=>'required', 
        ]);
        try{ 
            DB::beginTransaction();
            $id = decrypt($request->id);
            $transaction = Transaction::find($id);
            $transaction->update(['shipping_detail'=>$request->shipping_detail]);
            DB::commit();  
            $email = $transaction->getCustomer?$transaction->getCustomer->email:'';
            event(new SendEmailEvent( $email, env('ADMIN_EMAIL'), false, 'shipping_detail', $transaction));

            return response()->json(['status' => true, 'success' =>true, 'message' =>"Shipping Detail Added", ]);
        }catch (\Exception $e){
            DB::rollback();
            return response()->json(['status' => false, 'success' =>false, 'message' => $e->getMessage()]);
        }
    }

}
