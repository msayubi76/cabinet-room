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
public function index($id)
{
try {
    $categories = Category::where('is_active', '1')->with('subcategories')->limit(12)->get();

    $cart = Cart::where('user_id', Auth::id())->get();
    $order = Order::where('user_id', Auth::id())->get();
    if (Order::where('user_id', Auth::id())->exists()){
        $order = Order::where('user_id', $id)->first();
        $order_detail = OrderDetail::where('order_id', $order->id)->get();





    return view('website.userdashboard.dashoard', compact('categories',  'cart', 'order','order_detail'));
}
else{
    return view('website.userdashboard.withoutorder', compact('categories',  'cart'));
}
}
catch (\Throwable $th) {
    return response()->json(['status' => false, 'message' => $th->getMessage()]);
}
}

}
