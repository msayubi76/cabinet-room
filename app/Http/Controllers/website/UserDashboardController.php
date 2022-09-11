<?php

namespace App\Http\Controllers\website;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserDashboardController extends Controller
{
public function index()
{
try {
    $categories = Category::where('is_active', '1')->with('subcategories')->limit(12)->get();

    $cart = Cart::where('user_id', Auth::id())->get();
    $orders = Order::where('user_id', Auth::id())->get();








    return view('website.userdashboard.dashoard', compact('categories',  'cart', 'orders'));



}
catch (\Throwable $th) {
    return response()->json(['status' => false, 'message' => $th->getMessage()]);
}
}

public function updateinfo(UserRequest $request)
{
    try {
        $user_response = UserService::update($request, auth()->user());
        return $user_response;
    } catch (\Throwable $th) {
        return response()->json(['status' => false, 'message' => $th->getMessage()]);
    }
}

function changePassword(Request  $request)
{

    $request->validate([
        'oldpassword' => 'required',
        'password' => 'required|confirmed',


    ]);
    #Match The Old Password
    if (!Hash::check($request->oldpassword, auth()->user()->password)) {
        return response()->json(['status' => 0, 'msg' => 'Old Password Doesnt match!']);
    }
    #Update the new Password
    User::whereId(auth()->user()->id)->update([
        'password' => Hash::make($request->password)
    ]);

    return response()->json(['status' => 1, 'msg' => "Password changed successfully!"]);
}

}
