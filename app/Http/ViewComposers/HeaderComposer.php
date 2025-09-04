<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Variation;
use Illuminate\Support\Facades\Auth;

class HeaderComposer
{
    public function compose(View $view)
    {
        $categories = Category::where('is_active', '1')->with(['subcategories', 'products.category' => function ($query) {
            return $query->where('is_active', 1)->limit(24);
        }])->get();

        $cart = [];
        if (Auth::user()) {

            $cart = Cart::where('user_id', Auth::id())->get();
        } else {


            // ✅ Guest user → load from session
            $sessionCart = session()->get('cart', []);

            $cart = collect($sessionCart)->map(function ($item) {
                $product   = Product::with('images')->find($item['product_id']); // eager load product data
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

        

        $view->with('categories', $categories)
            ->with('cart', $cart);
    }
}
