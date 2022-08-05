<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Sub_Category;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use Illuminate\Auth\Events\Validated;


class ProductController extends Controller
{
    public function index(){
        $product = ProductService::getproducts();
        return view('admin.product.index',compact('product'));
       }

       public function create(){
        $category = Category::all();
        return view('admin.product.create',compact('category'));
       }

       public function store(ProductRequest $request){
        try {
            $product_response = ProductService::store($request);
            return $product_response;
        } catch (\Throwable $th) {
            return $th;
        }
       }
       public function edit($id){
        $product = Product::find($id);
        $category = Category::all();

            return view('admin.product.edit',compact('product','category'));
           }

       public function update(ProductRequest $request, Product $product){
        try {
           $product_response = ProductService::update($request,$product);
           return $product_response;
        } catch (\Throwable $th) {
           return $th;
        }
    }
    public function destroy($id){
        try {
             $product_response = ProductService::destroy($id);
             return $product_response;
        } catch (\Throwable $th) {
            return $th;
        }
     }

    //    public function store(ProductRequest $request){
    //     $data =$request->Validated();

    //     $product = new Product();

    //     $product->name = $data['name'];
    //     $product->category_id = $data['category_id'];
    //     $product->subcategory_id = $data['subcategory_id'];


    //          $product->description = $data['description'];
    //          $product->actual_price = $data['actual_price'];
    //          $product->discount = $data['discount'];
    //          $product->shipping_charge = $data['shipping_charge'];
    //          $product->colour = $data['colour'];
    //          if($request->hasfile('feature_image'))
    //    {
    //        $file = $request->file('feature_image');
    //        $filename = time() . '.' . $file->Extension();
    //        $file->move('uploads/product', $filename);
    //        $product->feature_image =  $filename;
    //    }
    //    if($request->hasfile('images'))
    //    {

    //        $file = $request->file('images');
    //        $filename = time() . '.' . $file->Extension();
    //        $file->move('uploads/multiimages', $filename);
    //        $product->images =  $filename;
    //    }

    //    $product->length = $data['length'];
    //    $product->width = $data['width'];

    //          $product->save();
    //          return redirect('admin/products')->with('message','product added successfully');

    //    }


    //     public function edit()
    //    {

    //     $product = Product::find($id);
    //     return view('admin.product.update',compact('product'));
    //    }
       public function getSubCategory(Request $request){
        // return $request;
         return Sub_Category::where('category_id',$request->id)->get();
     }

}
