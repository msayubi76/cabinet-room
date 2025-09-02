<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Variation;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class CartController extends Controller
{

    public function addProduct2(Request $request)
    {
        try {
            $product_id = $request->product_id;
            $quantity = $request->quantity;
            $variation_id = $request->color;

            if (Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
                return response()->json(['status' => 'Item is Alredy Added']);
            } else {
                $cart = new Cart();
                $cart->product_id = $product_id;
                $cart->user_id = Auth::id();
                $cart->quantity = $quantity;
                $cart->variation_id = $variation_id;
                $cart->save();
                return response()->json(['status' =>  'Item added to your cart']);
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function addProduct(Request $request)
    {
        try {
            $product_id   = $request->product_id;
            $quantity     = $request->quantity;
            $variation_id = $request->color;

            if (Auth::check()) {
                // ✅ User is logged in → save to DB
                $userId = Auth::id();

                if (Cart::where('product_id', $product_id)
                    ->where('variation_id', $variation_id)
                    ->where('user_id', $userId)
                    ->exists()
                ) {
                    return response()->json(['status' => 'Item is already in your cart']);
                }

                $cart = new Cart();
                $cart->product_id   = $product_id;
                $cart->user_id      = $userId;
                $cart->quantity     = $quantity;
                $cart->variation_id = $variation_id;
                $cart->save();

                return response()->json(['status' => 'Item added to your cart']);
            } else {
                // ✅ Guest user → save to session
                $cart = session()->get('cart', []);

                $key = $product_id . '_' . $variation_id; // unique key per product + variation

                if (isset($cart[$key])) {
                    $cart[$key]['quantity'] += $quantity;
                } else {
                    $cart[$key] = [
                        'product_id'   => $product_id,
                        'quantity'     => $quantity,
                        'variation_id' => $variation_id
                    ];
                }

                session()->put('cart', $cart);

                return response()->json(['status' => 'Item added to your cart.']);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }




    public function viewCart()
    {
        try {
            $categories = Category::where('is_active', '1')
                ->with('subcategories')
                ->limit(12)
                ->get();

            if (Auth::check()) {
                // ✅ Logged-in user → load from DB
                $cart = Cart::with(['product', 'variation'])
                    ->where('user_id', Auth::id())
                    ->get();
            } else {
                // ✅ Guest user → load from session
                $sessionCart = session()->get('cart', []);

                $cart = collect($sessionCart)->map(function ($item) {
                    $product   = Product::with('images')->find($item['product_id']);
                    $variation = Variation::find($item['variation_id']);


                    return (object) [
                        'product_id'   => $item['product_id'],
                        'variation_id' => $item['variation_id'],
                        'quantity'     => $item['quantity'],
                        'product'      => $product,
                        'variation'    => $variation,
                    ];
                });
            }

            return view('website.pages.cart', compact('categories', 'cart'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    public function update2(Request $request)
    {

        try {
            $product_id = $request->product_id;
            $quantity = $request->quantity;
            $update_cart = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
            $update_cart->quantity = $quantity;
            $update_cart->update();
            $cart = Cart::where('user_id', Auth::id())->with('product')->get();
            return response()->json(['message' => 'Cart item updated successfully.', 'data' => $cart, 'status' => true]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(),   'status' => false]);
        }
    }


    public function update(Request $request)
    {
        try {
            $product_id   = $request->product_id;
            $variation_id = $request->variation_id; // make sure to send variation id too
            $quantity     = $request->quantity;

            if (Auth::check()) {
                // ✅ Logged-in user → update DB cart
                $update_cart = Cart::where('product_id', $product_id)
                    ->where('variation_id', $variation_id)
                    ->where('user_id', Auth::id())
                    ->first();

                if (!$update_cart) {
                    return response()->json(['message' => 'Cart item not found.', 'status' => false]);
                }

                $update_cart->quantity = $quantity;
                $update_cart->save();

                $cart = Cart::where('user_id', Auth::id())
                    ->with(['product', 'variation'])
                    ->get();
            } else {
                // ✅ Guest user → update session cart
                $cart = session()->get('cart', []);

                $key = $product_id . '_' . $variation_id;
               

                if (isset($cart[$key])) {
                    $cart[$key]['quantity'] = $quantity;
                    session()->put('cart', $cart);
                } else {
                    return response()->json(['message' => 'Cart item not found in session.', 'status' => false]);
                }

                // transform session cart into object-like response
                $cart = collect($cart)->map(function ($item) {
                    $product   = Product::with('images')->find($item['product_id']);
                    $variation = Variation::find($item['variation_id']);

                    return (object) [
                        'product_id'   => $item['product_id'],
                        'variation_id' => $item['variation_id'],
                        'quantity'     => $item['quantity'],
                        'product'      => $product,
                        'variation'    => $variation,
                    ];
                })->values();
            }

            return response()->json([
                'message' => 'Cart item updated successfully.',
                'data'    => $cart,
                'status'  => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status'  => false
            ]);
        }
    }



    // public function delete(Request $request)
    // {
    //     try {
    //         $product_id = $request->product_id;
    //         $cart = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
    //         $cart->delete();
    //         return response()->json(['message' => 'Item deleted successfully from cart.',   'status' => true]);
    //     } catch (\Throwable $th) {
    //         return response()->json(['message' => $th->getMessage(),   'status' => false]);
    //     }
    // }


    public function delete(Request $request)
    {
        try {
            $product_id = $request->product_id;


            if (Auth::check()) :
                // ✅ Logged-in user → delete from DB
                $cart = Cart::where('product_id', $product_id)
                    ->where('user_id', Auth::id())
                    ->first();

                if ($cart):
                    $cart->delete();
                endif;

                return response()->json([
                    'message' => 'Item deleted successfully from cart.',
                    'status' => true,
                    'cart' => Cart::where('user_id', Auth::id())->with('product')->get()
                ]);
            else:
                // ✅ Guest user → delete from session
                $cart = session()->get('cart', []);
                // Build the same key used while storing
                $key = $product_id . '_' . ($variation_id ?? '');


                if (isset($cart[$key])):
                    unset($cart[$key]); // remove item
                    session()->put('cart', $cart); // save updated cart
                endif;
                return response()->json(['message' => 'Item deleted successfully from cart.',   'status' => true]);
            endif;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ]);
        }
    }
}
