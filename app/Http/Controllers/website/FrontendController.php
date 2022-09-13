<?php

namespace App\Http\Controllers\website;

use App\Models\Cart;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Services\SettingService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{

    public function index()
    {
        try {
            $categories = Category::where('is_active', '1')->with('subcategories')->get();




            $featuredProducts = Product::where('is_feature_product', '1')->where('is_active', '1')->get();
            $arrivialProducts = Product::where('is_arrival_product', '1')->where('is_active', '1')->get();
            $featuredProductsFooter = Product::where('is_feature_product', '1')->where('is_active', '1')->limit(3)->get();
            $latestrPoductsFooter = Product::orderBy('id', 'DESC')->where('is_active', '1')->limit(3)->get();
            $arrivialProductsFooter = Product::where('is_arrival_product', '1')->where('is_active', '1')->limit(3)->get();
            $cart = Cart::where('user_id', Auth::id())->get();
            $banners = Banner::orderBy('id', 'DESC')->get();

            return view('website.index', compact('categories',  'featuredProducts', 'arrivialProducts', 'featuredProductsFooter', 'arrivialProductsFooter', 'latestrPoductsFooter', 'cart', 'banners'));
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function categories()
    {
        try {

            $categories = Category::where('is_active', '1')->with('subcategories')->get();

            $cart = Cart::where('user_id', Auth::id())->get();
            return view('website.pages.categories', compact('categories', 'subcategory', 'cart'));
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }
    public function products()
    {
        try {
            $products = Product::orderBy('id', 'DESC')->where('is_active', '1')->paginate(30);

            $categories = Category::where('is_active', '1')->with('subcategories')->where('is_active', '1')->get();
            $featuredProducts = Product::where('is_feature_product', '1')->where('is_active', '1')->get();
            $cart = Cart::where('user_id', Auth::id())->get();
            return view('website.pages.shop', compact('categories',  'products', 'cart', 'featuredProducts'));
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function singleProduct($id)
    {
        try {
            $product = Product::find($id);
            $relatedProducts = Product::orderBy('id', 'DESC')->where('is_active', '1')->get();
            $featuredProductsFooter = Product::where('is_feature_product', '1')->where('is_active', '1')->limit(3)->get();
            $latestPoductsFooter = Product::orderBy('id', 'DESC')->where('is_active', '1')->limit(3)->get();
            $arrivialProductsFooter = Product::where('is_arrival_product', '1')->where('is_active', '1')->limit(3)->get();
            $categories = Category::where('is_active', '1')->with('subcategories')->get();
            $featuredProductsPrevese = Product::where('is_feature_product', '1')->where('is_active', '1')->limit(1)->get();
            $latestPoductsNext = Product::orderBy('id', 'DESC')->where('is_active', '1')->limit(1)->get();

            $cart = Cart::where('user_id', Auth::id())->get();
            return view('website.pages.single-product', compact('categories',  'product', 'relatedProducts', 'featuredProductsFooter', 'arrivialProductsFooter', 'cart', 'latestPoductsFooter', 'featuredProductsPrevese', 'latestPoductsNext'));
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function about()
    {
        try {
            $setting = SettingService::getSetting();
            $categories = Category::where('is_active', '1')->with('subcategories')->get();

            $cart = Cart::where('user_id', Auth::id())->get();
            return view('website.pages.about', compact('categories',  'cart', 'setting'));
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function contact()
    {
        try {
            $setting = SettingService::getSetting();
            $categories = Category::where('is_active', '1')->with('subcategories')->get();;

            $cart = Cart::where('user_id', Auth::id())->get();
            return view('website.pages.contact', compact('categories',  'cart', 'setting'));
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function policy()
    {
        try {
            $setting = SettingService::getSetting();
            $categories = Category::where('is_active', '1')->with('subcategories')->get();

            $cart = Cart::where('user_id', Auth::id())->get();
            return view('website.pages.privacy-and-policy', compact('categories',  'cart', 'setting'));
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function category($name)
    {
        try {

            $categories = Category::where('is_active', '1')->with('subcategories')->get();
            $featuredProducts = Product::where('is_feature_product', '1')->where('is_active', '1')->get();

            $cart = Cart::where('user_id', Auth::id())->get();
            if (Category::where('name', $name)->exists()) {
                $category = Category::where('name', $name)->first();
                $products = Product::where('category_id', $category->id)->where('is_active', '1')->paginate(30);
                return view('website.category.product-with-category', compact('category', 'categories',  'products', 'featuredProducts', 'cart'));
            } else {
                return redirect('/')->with('status', 'Category Dosent Exists');
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function subCategory($name)
    {
        try {

            $categories = Category::where('is_active', '1')->with('subcategories')->get();
            $featuredProducts = Product::where('is_feature_product', '1')->where('is_active', '1')->get();
            $cart = Cart::where('user_id', Auth::id())->get();
            if (SubCategory::where('name', $name)->exists()) {
                $subcategory = SubCategory::where('name', $name)->first();
                $products = Product::where('sub_category_id', $subcategory->id)->where('is_active', '1')->paginate(30);
                return view('website.category.product-with-subcategory', compact('subcategory', 'categories',  'products', 'featuredProducts', 'cart'));
            } else {
                return redirect('/')->with('status', 'SubCategory Dosent Exists');
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function productList()
    {
        try {
            $product = Product::select('name')->paginate(30);
            $data = [];
            foreach ($product as $product_list) {
                $data[] = $product_list['name'];
            }
            return $data;
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function searchProduct(Request $request)
    {
        try {
            $product_search = $request->name;
            if ($product_search != "") {
                $product = Product::where("name", "like", "%$product_search%")->first();
                if ($product) {
                    return redirect('product/' . $product->id);
                } else {
                    return redirect()->back()->with("status", "No product match your search");
                }
            } else {
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }
}
