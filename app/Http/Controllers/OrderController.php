<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
    try {

        $orders = Order::orderBy('id', 'DESC')->get();
        // $order_detail = OrderDetail::where('order_id',$orders->id)->get();
        // dd($order_detail);
        return view('admin.orders.index', compact( 'orders'));
    }
    catch (\Throwable $th) {
        return response()->json(['status' => false, 'message' => $th->getMessage()]);
    }
    }
}
