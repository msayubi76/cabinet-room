<?php

namespace App\Http\Controllers\website;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\Sub_Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
   public function index()
   {
      $category = Category::where('is_active', '0')->get();
      $subcategory = Sub_Category::where('is_active', '0')->get();
      $featured_product = Product::where('is_feature_product', '1')->get();
      $arrivial_product = Product::where('is_arrival_product', '1')->get();
      $cart = Cart::where('user_id',Auth::id())->get();

      return view('website.index', compact('category', 'subcategory', 'featured_product', 'arrivial_product','cart'));
   }

   public function products()
   {
      $product = Product::orderBy('id', 'DESC')->paginate(30);
      $category = Category::where('is_active', '0')->get();
      $subcategory = Sub_Category::where('is_active', '0')->get();
      $cart = Cart::where('user_id',Auth::id())->get();
      return view('website.product.shop', compact('category', 'subcategory', 'product','cart'));
   }
   public function singleproduct($id)
   {


      $product = Product::find($id);
      $category = Category::where('is_active', '0')->get();
      $subcategory = Sub_Category::where('is_active', '0')->get();
      $cart = Cart::where('user_id',Auth::id())->get();
      return view('website.product.singleProduct', compact('category', 'subcategory', 'product','cart'));
   }

}
