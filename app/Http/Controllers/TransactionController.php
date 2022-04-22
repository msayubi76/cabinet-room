<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
       
    } 

    public function getReservedCars()
    {
        try {

            $title = "Draft";
            $type = "Draft Products";

            $cars = Transaction::where('customer_id', Auth::user()->id)
            ->where('order_status','<>' ,'completed')
            ->get(); 
            return view('customer/index',compact('cars', 'title', 'type'));
  
        } catch (\Throwable $th) {
            DB::rollback(); 
            return redirect('dashboard')->with('error', $th->getMessage()); 
        }
    }

   

    public function getShippedCars()
    {
        try {
            $title = "Draft";
            $type = "Orders List";
            $items = Transaction::where('customer_id', Auth::user()->id)
            ->where('order_status' ,'completed')
            ->get(); 
            return view('customer/index',compact('items', 'title', 'type'));
        } catch (\Throwable $th) {
            DB::rollback(); 
            return redirect('dashboard')->with('error', $th->getMessage()); 
        }
    }
}
