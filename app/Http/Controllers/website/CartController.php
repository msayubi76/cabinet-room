<?php

namespace App\Http\Controllers\website;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add_product(Request $request){
        $product_id =$request->input('product_id');
        $product_quantity =$request->input('product_quantity');

        if(Auth::check())
        {
            $product = Product::where('id',$product_id)->first();
            if($product){
                if(Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists())
                {
                    return response()->json(['status'=> $product->name. 'Product is alredy Addded']);
                }
                else
                {
                    $cart = new Cart();
                    $cart->product_id = $product_id;
                    $cart->user_id = Auth::id();
                    $cart->product_quantity = $product_quantity;
                    $cart->save();

                  return response()->json(['status'=> $product->name. 'Add to cart']);
                }

            }

        }
        else{
            return response()->json(['status'=>'loggin to continue']);
        }

    }
}
