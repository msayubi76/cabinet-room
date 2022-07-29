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
    $product = Product::all();
    return view('admin.product.index',compact('product'));
   }

   public function create(){
    $category = Category::all();
    return view('admin.product.create',compact('category'));
   }

   public function store(ProductRequest $request){
    $data =$request->Validated();

    $product = new Product();

    $product->name = $data['name'];
    $product->category_id = $data['category_id'];
    $product->subcategory_id = $data['subcategory_id'];


         $product->description = $data['description'];
         $product->actual_price = $data['actual_price'];
         $product->discount = $data['discount'];
         $product->shipping_charge = $data['shipping_charge'];
         $product->colour = $data['colour'];
         if($request->hasfile('feature_image'))
   {
       $file = $request->file('feature_image');
       $filename = time() . '.' . $file->Extension();
       $file->move('uploads/product', $filename);
       $product->feature_image =  $filename;
   }
   if($request->hasfile('images'))
   {
    foreach($request->file('images') as $image)
    {
        $name=$image->getClientOriginalName();
        $image->move('uploads/multiimages', $name);
        $data[] = $name;
    }
    //    $file = $request->file('images');
    //    $filename = time() . '.' . $file->Extension();
    //    $file->move('uploads/multiimages', $filename);
    //    $product->images =  $filename;
   }
   $product->images=json_encode($data);
   $product->length = $data['length'];
   $product->width = $data['width'];

         $product->save();
         return redirect('admin/products')->with('message','product added successfully');

   }

   public function edit($product_id){
$product = Product::find($product_id);
$category = Category::all();

    return view('admin.product.edit',compact('product','category'));
   }
//     public function edit()
//    {

//     $product = Product::find($id);
//     return view('admin.product.update',compact('product'));
//    }
   public function getSubCategory(Request $request){
    // return $request;
     return SubCategory::where('category_id',$request->id)->get();
 }

}
