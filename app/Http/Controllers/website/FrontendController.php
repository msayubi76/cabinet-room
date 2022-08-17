<?php
namespace App\Http\Controllers\website;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class FrontendController extends Controller
{

public function index()
{
try {
    $category = Category::where('is_active', '0')->get();
    $subcategory = SubCategory::where('is_active', '0')->get();
    $featured_product = Product::where('is_feature_product', '1')->get();
    $arrivial_product = Product::where('is_arrival_product', '1')->get();
    $cart = Cart::where('user_id', Auth::id())->get();
    return view('website.index', compact('category', 'subcategory', 'featured_product', 'arrivial_product', 'cart'));
} 
catch (\Throwable $th) {
return response()->json(['status' => false, 'message' => $th->getMessage()]);
}
}

public function products()
{
try {
    $product = Product::orderBy('id', 'DESC')->paginate(30);
    $category = Category::where('is_active', '0')->get();
    $subcategory = SubCategory::where('is_active', '0')->get();
    $cart = Cart::where('user_id', Auth::id())->get();
    return view('website.product.shop', compact('category', 'subcategory', 'product', 'cart'));
}
 catch (\Throwable $th) {
return response()->json(['status' => false, 'message' => $th->getMessage()]);
}
}

public function singleProduct($id)
{
try {
    $product = Product::find($id);
    $category = Category::where('is_active', '0')->get();
    $subcategory = SubCategory::where('is_active', '0')->get();
    $cart = Cart::where('user_id', Auth::id())->get();
    return view('website.product.singleProduct', compact('category', 'subcategory', 'product', 'cart'));
}
 catch (\Throwable $th) {
return response()->json(['status' => false, 'message' => $th->getMessage()]);
}
}

public function about()
{
try {
    $category = Category::where('is_active', '0')->get();
    $subcategory = SubCategory::where('is_active', '0')->get();
    $cart = Cart::where('user_id', Auth::id())->get();
    return view('website.pages.about', compact('category', 'subcategory', 'cart'));
} 
catch (\Throwable $th) {
return response()->json(['status' => false, 'message' => $th->getMessage()]);
}
}

public function contact()
{
try {
    $category = Category::where('is_active', '0')->get();
    $subcategory = SubCategory::where('is_active', '0')->get();
    $cart = Cart::where('user_id', Auth::id())->get();
    return view('website.pages.contact', compact('category', 'subcategory', 'cart'));
} 
catch (\Throwable $th) {
return response()->json(['status' => false, 'message' => $th->getMessage()]);
}
}

public function policy()
{
try {
    $category = Category::where('is_active', '0')->get();
    $subcategory = SubCategory::where('is_active', '0')->get();
    $cart = Cart::where('user_id', Auth::id())->get();
    return view('website.pages.privacy-and-policy', compact('category', 'subcategory', 'cart'));
} 
catch (\Throwable $th) {
return response()->json(['status' => false, 'message' => $th->getMessage()]);
}
}

public function category($name)
{
try {
    $subcategory = SubCategory::where('is_active', '0')->get();
    $category = Category::where('is_active', '0')->get();
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
    return redirect('products/' . $product->id);
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