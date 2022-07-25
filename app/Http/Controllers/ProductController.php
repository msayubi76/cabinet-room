<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Auth\Events\Validated;

class ProductController extends Controller
{
   public function index(){
    return view('admin.product.index');
   }

   public function create(){
    $category = Category::all();
    return view('admin.product.create',compact('category'));
   }

   public function store(ProductRequest $request){
    $data =$request->Validated();

    $product = new Product();

    $product->name = $data['name'];
    $category = Category::where('id',$request->category)->get();
    $product->category=$category->name;

        //  $subcategory = Subcategory::where('id',$data->subcategory)->get();
        //  $product->subcategory=$subcategory[0]->name;
        //  $product->description = $data['description'];
         $product->actual_price = $data['actual_price'];
         $product->discount = $data['discount'];
         $product->shipping_charge = $data['shipping_charge'];
         $product->colour = $data['colour'];

         $product->save();
         return redirect('admin/product')->with('message','product added successfully');

   }
   public function getSubCategory(Request $request){
    // return $request;
     return SubCategory::where('category_id',$request->id)->get();
 }

}
