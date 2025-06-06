<?php

namespace App\Http\Controllers\website;

use App\Models\Cart;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\RequestQuote;

use Illuminate\Http\Request;
use App\Services\SettingService;
use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{

    public function index()
    {
        $categories = Category::where('is_active', '1')->with(['subcategories', 'products.category' => function ($query) {
            return $query->where('is_active', 1)->limit(18);
        }])->get();
        $featuredProducts = Product::where('is_feature_product', '1')->limit(12)->latest()->where('is_active', '1')->get();
        $arrivialProducts = Product::latest()->where('is_active', '1')->limit(12)->get();

        $cart = Cart::where('user_id', Auth::id())->get();
        $banners = Banner::orderBy('id', 'DESC')->where('name', 'home')->get();
        //$saleItems = Product::where('discount', '>', '0')->with(['category'])->limit(24)->latest()->where('is_active', '1')->limit(36)->get();

        $categoriesWithProducts = $categories->filter((function ($category) {
            return $category->products()->count() > 0;
        }));


        return view('website.index', compact('categories',  'featuredProducts', 'arrivialProducts',   'cart', 'banners', 'categoriesWithProducts'));
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
    public function products(Request $request, $category = null, $sub_category = null)
    {
        $min_price = $request->minPrice ? $request->minPrice : '';
        $max_price = $request->maxPrice ? $request->maxPrice : '';
        $products = new Product;
        if ($min_price != "") {
            $products =  $products->where('saleprice', '>', $min_price);
        }
        if ($max_price != "") {
            $products =  $products->where('saleprice', '<', $max_price);
        }
        $products = $products->latest()->where('is_active', '1');

        if ($category) :
            $categories =  Category::orWhere('name', 'like', "%{$category}%")->pluck('id');
            $products = $products->whereIn('category_id', $categories);
        endif;
        if ($sub_category) :
            $sub_categories =  SubCategory::orWhere('name', 'like', "%{$sub_category}%")->pluck('id');
            $products = $products->whereIn('sub_category_id', $sub_categories);
        endif;
        $products = $products->paginate(10);

        $categories = Category::where('is_active', '1')->with('subcategories')->where('is_active', '1')->get();
        $featuredProducts = Product::where('is_feature_product', '1')->where('is_active', '1')->get();
        $cart = Cart::where('user_id', Auth::id())->get();
        $min = round(Product::min('saleprice'));
        $max = round(Product::max('saleprice'));

        $banner = Banner::where('page_name', 'products')->orderBy('id', 'DESC')->first();

        return view('website.pages.shop', compact('categories',  'products', 'cart', 'featuredProducts', 'min', 'max', 'min_price', 'max_price', 'banner'));
    }
    public function productsFilter(Request $request)
    {
        try {
            $min_price = $request->minPrice ? $request->minPrice : '';
            $max_price = $request->maxPrice ? $request->maxPrice : '';
            $products = Product::latest()->where('is_active', '1')->where('saleprice', '>', $min_price)->where('saleprice', '<', $max_price);

            $products = $products->paginate(10);
            $categories = Category::where('is_active', '1')->with('subcategories')->where('is_active', '1')->get();
            $featuredProducts = Product::where('is_feature_product', '1')->where('is_active', '1')->get();
            $cart = Cart::where('user_id', Auth::id())->get();
            $min = round(Product::min('saleprice'));
            $max = round(Product::max('saleprice'));

            $banner = Banner::where('page_name', 'products')->orderBy('id', 'DESC')->first();

            return view('website.pages.shop', compact('categories',  'products', 'cart', 'featuredProducts', 'min', 'max', 'min_price', 'max_price', 'banner'));
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }
    public function singleProduct(Product $product)
    {
        $relatedProducts = Product::orderBy('id', 'DESC')->where('is_active', '1')->where('category_id', $product->category_id)->get();
        $featuredProductsFooter = Product::where('is_feature_product', '1')->where('is_active', '1')->limit(3)->get();
        $latestPoductsFooter = Product::orderBy('id', 'DESC')->where('is_active', '1')->limit(3)->get();
        $arrivialProductsFooter = Product::where('is_arrival_product', '1')->where('is_active', '1')->limit(3)->get();
        $categories = Category::where('is_active', '1')->with('subcategories')->get();
        $featuredProductsPrevese = Product::where('is_feature_product', '1')->where('is_active', '1')->limit(1)->get();
        $latestPoductsNext = Product::orderBy('id', 'DESC')->where('is_active', '1')->limit(1)->get();
        $product->load('variations');

        $colors = $product->variations()->where('name', 'color')->with('media')->get();



        $quoteCheck = true;
        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $resultQuote = RequestQuote::where('user_id', $user_id)->where('product_id', $product->id)->orderBy('created_at', 'desc')->first();
            if ($resultQuote) {
                $resultQuote->status == 2 ? $quoteCheck = true : $quoteCheck = false;
            }
        }
        $cart = Cart::where('user_id', Auth::id())->get();
        $productCheck = 1;
        foreach ($cart as $cartItem) {
            if ($cartItem->product_id == $product->id) {
                $productCheck = 0;
            }
        } 

        return view('website.pages.single-product', compact('categories', 'colors', 'product', 'relatedProducts', 'featuredProductsFooter', 'arrivialProductsFooter', 'cart', 'latestPoductsFooter', 'featuredProductsPrevese', 'latestPoductsNext', 'productCheck', 'quoteCheck'));
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



    public function productList()
    {
        try {
            $product = Product::select('name')->paginate(300);
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
            $minPrice = $request->minPrice ? $request->minPrice : '';
            $maxPrice = $request->maxPrice ? $request->maxPrice : '';
            $products = new Product;
            if ($minPrice != "") {
                $products =  $products->where('saleprice', '>', $minPrice);
            }
            if ($maxPrice != "") {
                $products =  $products->where('saleprice', '<', $maxPrice);
            }

            if ($product_search != "") {
                $productlist =  $products->where("name", "like", "%$product_search%")->with('category')->paginate(50);
                if ($productlist) {
                    $categories = Category::where('is_active', '1')->with('subcategories')->get();
                    $cart = Cart::where('user_id', Auth::id())->get();
                    $featuredProducts = Product::where('is_feature_product', '1')->limit(8)->latest()->where('is_active', '1')->get();
                    $min = round(Product::min('saleprice'));
                    $max = round(Product::max('saleprice'));

                    $banner = Banner::where('page_name', 'search')->orderBy('id', 'DESC')->first();


                    return view('website.pages.search', compact(['productlist', 'categories', 'cart', 'featuredProducts', 'product_search', 'min', 'max', 'minPrice', 'maxPrice', 'banner']));
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


    public function gallary()
    {
        $setting = SettingService::getSetting();
        $categories = Category::where('is_active', '1')->with('subcategories')->get();

        $cart = Cart::where('user_id', Auth::id())->get();
        $media = Media::orderBy('id', 'DESC')->get();
        return view('website.pages.gallary', compact('categories', 'cart', 'setting', 'media'));
    }
}
