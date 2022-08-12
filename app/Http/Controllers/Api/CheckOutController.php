<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BillingDetails;
use App\Models\ShippingDetails;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    public function index()
    {
        $category = Category::where('is_active', '0')->get();
            $subcategory = SubCategory::where('is_active', '0')->get();
            $cart = Cart::where('user_id', Auth::id())->get();
        return view('website.product.checkOut',compact('category', 'subcategory','cart'));
    }

    public function placeOrder(Request $request)
    {
      $billing = new BillingDetails();
      $billing->first_name = $request->first_name;
      $billing->last_name = $request->last_name;
      $billing->address = $request->address;
      $billing->city = $request->city;
      $billing->country = $request->country;
      $billing->post_code = $request->post_code;
      $billing->phone_number = $request->phone_number;
      $billing->email = $request->email;
      $billing->notes = $request->notes;
      $billing->save();

      $cart = Cart::where('user_id', Auth::id())->get();
      foreach ( $cart as $cartitem ) :

      ShippingDetails::create([
            'user_id' =>  $cartitem->user_id,
      ]);
    endforeach;
    }
}
