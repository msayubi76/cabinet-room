<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class CartController extends Controller
{

    public function addProduct(Request $request)
    {
        try {
            $product_id = $request->product_id;
            $quantity = $request->quantity;
            if(Auth::check()){
            $product = Product::where('id', $product_id)->first();
            if ($product) {
                if (Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
                    return response()->json(['status' => 'Product is Alredy Added']);
                } else {
                    $cart = new Cart();
                    $cart->product_id = $product_id;
                    $cart->user_id = Auth::id();
                    $cart->quantity = $quantity;
                    $cart->save();
                    return response()->json(['status' =>  'Has been added to your cart']);
                }
            }
        }else{
            return response()->json(['status' => 'loggin to continue']);

        }

        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function viewCart()
    {
        try {

            $categories = Category::where('is_active', '1')->with('subcategories')->limit(12)->get();

            $cart = Cart::where('user_id', Auth::id())->get();
            return view('website.pages.cart', compact('categories',  'cart'));
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function update(Request $request)
    {

        try {
            $product_id = $request->product_id;
            $quantity = $request->quantity;

            if (Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
                $update_cart = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();

                $update_cart->quantity = $quantity;
                $update_cart->update();
                return response()->json(['status' => 'Cart Iteam updated successfully.']);
            }

            return response()->json(['status' => 'Login  to continue']);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function delete(Request $request)
    {
        try {
            $product_id = $request->product_id;
            if (Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
                $cart = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                $cart->delete();
                return response()->json(['status' => 'Product deleted successfully from cart']);
            }
            return response()->json(['status' => 'loggin to continue']);
        } catch (\Throwable $th) {
            return $th;
        }
    }


}
