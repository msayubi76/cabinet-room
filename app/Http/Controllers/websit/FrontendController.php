<?php

namespace App\Http\Controllers\websit;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
   public function index(){
    $category = Category::where('is_active','0')->get();
    $subcategory = SubCategory::where('is_active','0')->get();
    $featured_product = Product::where('is_feature_product','1')->get();
    $arrivial_product = Product::where('is_arrival_product','1')->get();

    return view('website.index',compact('category','subcategory','featured_product','arrivial_product'));
   }

   public function product(){
    $product = Product::orderBy('id', 'DESC')->paginate(30);
    $category = Category::where('is_active','0')->get();
    $subcategory = SubCategory::where('is_active','0')->get();
    return view('website.product.shop',compact('category','subcategory','product'));

   }
   public function singleProduct($id){
    $product = Product::find($id);
    $category = Category::where('is_active','0')->get();
    $subcategory = SubCategory::where('is_active','0')->get();
    return view('website.product.singleProduct',compact('category','subcategory','product'));

   }
}





