<?php

namespace App\Services;



use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProductRequest;
use App\Models\SubCategory;
use App\Traits\FileUploadTrait;
class ProductService
{
    public static function getProducts(){

            $product = Product::orderBy('id', 'DESC')->paginate(30);
            return $product;

    }



    public static function store(ProductRequest $request)
    {


        DB::beginTransaction();
        $data = $request->validated();

        if ($request->hasFile('feature_image')) :
            $image_name = FileUploadTrait::fileUpload($request->feature_image, 'products');
            $data['folder_name'] = 'products';
            $data['feature_image_name'] =  $image_name;
            $data['feature_image'] = url('/storage/products/' . $image_name);
        endif;

        $product = Product::create($data);


        $image_name = FileUploadTrait::uploadMultipleFiles($request->images, $product, 'products');





        DB::commit();

        $response = ['status' => true, 'message' => 'product added successfully.', 'product' => $product];
        return $response;

    }

    public static function update(ProductRequest $request, Product $product){

        DB::beginTransaction();
        $data = $request->validated();
        if ($request->hasFile('feature_image')) :
            $image_name = FileUploadTrait::fileUpload($request->feature_image, 'products');
            $data['folder_name'] = 'products';
            $data['feature_image_name'] =  $image_name;
            $data['feature_image'] = url('/storage/products/' . $image_name);
        endif;

        $product->update($data);

        if ($request->hasFile('images')) :
            $image_name = FileUploadTrait::uploadMultipleFiles($request->images, $product, 'products');
        endif;


        DB::commit();
        $response = ['status' => true, 'message' => 'Product updated successfully.', 'product' => $product];
        return $response;
    }

    public static function destroy($id)
    {
        DB::beginTransaction();
        $product = Product::findorFail($id);
        $product->delete();
        DB::commit();
        $response = ['status' => true, 'message' => ' product removed successfully.'];
        return $response;
    }



    public static function detail(int $id)
    {
        $product = Product::findOrFail($id);
        $product->load('images');


        $sub_categories = SubCategory::where('category_id',$product->category_id)->cursor();


        return ['product' => $product, 'sub_categories' => $sub_categories];
    }

}
