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

        $orders = Order::orderBy('id', 'DESC')->paginate(20);


        return view('admin.orders.index', compact('orders'));
    }
    catch (\Throwable $th) {
        return response()->json(['status' => false, 'message' => $th->getMessage()]);
    }
    }

    public function orderType($order_type)

    {

    try {
       $orders = Order::where('order_status',$order_type)->paginate(20);
        return view('admin.orders.index',compact('orders'));


    }
    catch (\Throwable $th) {
        return response()->json(['status' => false, 'message' => $th->getMessage()]);
    }
    }

    public function viewOrder(Order $order)
    {

    try {
        $order_items = $order->orderDetails()->with('products')->get();
        $payment = $order->payments;

        $shipping_detail = $order->shipping;

        return view('admin.orders.view-orderdetail', compact( 'order_items','shipping_detail','payment'));
    }
    catch (\Throwable $th) {
        return response()->json(['status' => false, 'message' => $th->getMessage()]);
    }
    }

    public function updateStatus(Request $request,$order_type)
    {


    try {
        // $id = $request->id;
        //     $order_status = $request->order_status;

        //     if (Order::where('id', $id)->exists()) {
        //         $update_status = Order::where('id', $id)->first();



        //         $update_status->order_status = $order_status;
        //         $update_status->update();

        //         return response()->json(['status' => true, 'message' => 'Status updated successfully.']);
        $order = Order::Find($order_type);
        dd($order);

    }

    catch (\Throwable $th) {
        return response()->json(['status' => false, 'message' => $th->getMessage()]);
    }
    }
}
