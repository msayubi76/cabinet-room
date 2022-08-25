<?php

namespace App\Http\Controllers\website;

use App\Models\Cart;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
public function index()
{
try {
    $category = Category::where('is_active', '0')->get();
    $subcategory = SubCategory::where('is_active', '0')->get();
    $cart = Cart::where('user_id', Auth::id())->get();
    $order = Order::where('user_id', Auth::id())->get();

    // $order_detail = OrderDetail::where('order_id',$order)->get();
    // dd($order_detail);


    return view('website.userdashboard.dashoard', compact('category', 'subcategory', 'cart', 'order'));
}
catch (\Throwable $th) {
    return response()->json(['status' => false, 'message' => $th->getMessage()]);
}
}

}
