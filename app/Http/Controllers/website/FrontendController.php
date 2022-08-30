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
    $category = Category::where('is_active', '1')->with('subcategories')->limit(12)->get();


    $subcategory = SubCategory::where('is_active', '1')->get();

    $featured_product = Product::where('is_feature_product', '1')->limit(3)->get();
    $latest_product = Product::orderBy('id','DESC')->limit(3)->get();
    $arrivial_product = Product::where('is_arrival_product', '1')->limit(3)->get();
    $cart = Cart::where('user_id', Auth::id())->get();
    $banners = Banner::orderBy('id','DESC')->get();

    return view('website.index', compact('category', 'subcategory', 'featured_product', 'arrivial_product', 'latest_product', 'cart','banners'));
}
catch (\Throwable $th) {
return response()->json(['status' => false, 'message' => $th->getMessage()]);
}
}

public function categories()
{
try {

     $category = Category::where('is_active', '1')->with('subcategories')->limit(12)->get();
    $subcategory = SubCategory::where('is_active', '1')->get();
    $cart = Cart::where('user_id', Auth::id())->get();
    return view('website.pages.categories', compact('category', 'subcategory', 'cart'));
}
 catch (\Throwable $th) {
return response()->json(['status' => false, 'message' => $th->getMessage()]);
}
}
public function products()
{
try {
    $product = Product::orderBy('id', 'DESC')->paginate(30);
     $category = Category::where('is_active', '1')->with('subcategories')->limit(12)->get();
    $subcategory = SubCategory::where('is_active', '1')->get();
    $featured_product = Product::where('is_feature_product', '1')->get();
    $cart = Cart::where('user_id', Auth::id())->get();
    return view('website.pages.shop', compact('category', 'subcategory', 'product', 'cart','featured_product'));
}
 catch (\Throwable $th) {
return response()->json(['status' => false, 'message' => $th->getMessage()]);
}
}

public function singleProduct($id)
{
try {
    $product = Product::find($id);
    $related_product = Product::orderBy('id', 'DESC')->limit(3)->get();
    $featured_product = Product::where('is_feature_product', '1')->limit(3)->get();
    $latest_product = Product::orderBy('id','DESC')->limit(3)->get();
    $arrivial_product = Product::where('is_arrival_product', '1')->limit(3)->get();
     $category = Category::where('is_active', '1')->with('subcategories')->limit(12)->get();
    $subcategory = SubCategory::where('is_active', '1')->get();
    $cart = Cart::where('user_id', Auth::id())->get();
    return view('website.pages.single-product', compact('category', 'subcategory', 'product', 'arrivial_product', 'featured_product', 'latest_product','cart','related_product'));
}
 catch (\Throwable $th) {
return response()->json(['status' => false, 'message' => $th->getMessage()]);
}
}

public function about()
{
try {
    $setting = SettingService::getSetting();
     $category = Category::where('is_active', '1')->with('subcategories')->limit(12)->get();
    $subcategory = SubCategory::where('is_active', '1')->get();
    $cart = Cart::where('user_id', Auth::id())->get();
    return view('website.pages.about', compact('category', 'subcategory', 'cart','setting'));
}
catch (\Throwable $th) {
return response()->json(['status' => false, 'message' => $th->getMessage()]);
}
}

public function contact()
{
try {
    $setting = SettingService::getSetting();
    $category = Category::where('is_active', '1')->first();
    $category_id = $category->id;
    $subcategory = SubCategory::where('category_id',$category_id)->where('is_active', '1')->get();
    $cart = Cart::where('user_id', Auth::id())->get();
    return view('website.pages.contact', compact('category', 'subcategory', 'cart','setting'));
}
catch (\Throwable $th) {
return response()->json(['status' => false, 'message' => $th->getMessage()]);
}
}

public function policy()
{
try {
    $setting = SettingService::getSetting();
     $category = Category::where('is_active', '1')->with('subcategories')->limit(12)->get();
    $subcategory = SubCategory::where('is_active', '1')->get();
    $cart = Cart::where('user_id', Auth::id())->get();
    return view('website.pages.privacy-and-policy', compact('category', 'subcategory', 'cart','setting'));
}
catch (\Throwable $th) {
return response()->json(['status' => false, 'message' => $th->getMessage()]);
}
}

public function category($name)
{
try {
    $subcategory = SubCategory::where('is_active', '1')->get();
     $category = Category::where('is_active', '1')->with('subcategories')->limit(12)->get();
    $cart = Cart::where('user_id', Auth::id())->get();
    if (Category::where('name', $name)->exists()) {
    $get_category = Category::where('name', $name)->first();
    $product = Product::where('category_id', $get_category->id)->get();
    return view('website.category.product-with-category', compact('get_category', 'category', 'subcategory', 'product', 'cart'));
    } else {
    return redirect('/')->with('status', 'Category Dosent Exists');
    }
}
 catch (\Throwable $th) {
return response()->json(['status' => false, 'message' => $th->getMessage()]);
}
}

public function subCategory($name)
{
try {
    $subcategory = SubCategory::where('is_active', '1')->get();
     $category = Category::where('is_active', '1')->with('subcategories')->limit(12)->get();
    $cart = Cart::where('user_id', Auth::id())->get();
    if (SubCategory::where('name', $name)->exists()) {
    $get_subcategory = SubCategory::where('name', $name)->first();
    $product = Product::where('sub_category_id', $get_subcategory->id)->get();
    return view('website.category.product-with-subcategory', compact('get_subcategory', 'category', 'subcategory', 'product', 'cart'));
    } else {
    return redirect('/')->with('status', 'SubCategory Dosent Exists');
    }
}
 catch (\Throwable $th) {
return response()->json(['status' => false, 'message' => $th->getMessage()]);
}
}

public function productList()
{
try {
    $product = Product::select('name')->get();
    $data = [];
    foreach ($product as $product_list) {
    $data[] = $product_list['name'];
    }
    return $data;
}
 catch (\Throwable $th) {
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
}
 catch (\Throwable $th) {
return response()->json(['status' => false, 'message' => $th->getMessage()]);
}
}
}
