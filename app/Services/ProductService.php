<?php

namespace App\Services;



use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductVariationRequest;
use App\Models\SubCategory;
use App\Models\Variation;
use App\Traits\FileUploadTrait;

class ProductService
{
    public static function getProducts()
    {

        $product = Product::orderBy('id', 'DESC')->paginate(20);
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

        $product->update(['sku' => sprintf('CB01' . "%'06d", $product->id)]);
        $have_variations = $request->have_variations;

        if ($have_variations) :
            $Variations = $request->Variation;
            
            foreach ($Variations as $key => $variation) :
                $array = [
                    "name" =>  $variation['name'],
                    "value" => $variation['value'],
                    "price" => $variation['price'],
                    "stock" => $variation['stock'],
                    "discount" => $variation['discount'],
                    "sale_price" => $variation['sale_price'],
                    "product_id" => $product->id,
                ];
                $var =    Variation::create($array);
                if (isset($variation['images']) && count($variation['images']) > 0) :
                    $image_name = FileUploadTrait::uploadMultipleFiles($variation['images'], $var, 'variations');
                endif;
            endforeach;
        endif;

        $image_name = FileUploadTrait::uploadMultipleFiles($request->images ? $request->images : [], $product, 'products');
        DB::commit();

        $response = ['status' => true, 'message' => 'Product added successfully.', 'product' => $product];
        return $response;
    }

    public static function update(ProductRequest $request, Product $product)
    {

        DB::beginTransaction();
        $data = $request->validated();
        if ($request->hasFile('feature_image')) :
            $image_name = FileUploadTrait::fileUpload($request->feature_image, 'products');
            $data['folder_name'] = 'products';
            $data['feature_image_name'] =  $image_name;
            $data['feature_image'] = url('/storage/products/' . $image_name);
        endif;
        $data['is_active']  = $request->is_active ? 1 : 0;
        $data['is_for_request_quote']  = $request->is_for_request_quote ? 1 : 0;
        $data['is_installment_available']  = $request->is_installment_available ? 1 : 0;
        $data['is_feature_product']  = $request->is_feature_product ? 1 : 0;
        $data['is_arrival_product']  = $request->is_arrival_product ? 1 : 0;

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

    public static function updateVariation(ProductVariationRequest $request, Variation $variation = null)
    {
        DB::beginTransaction();
        if ($variation) :
            $variation->update($request->validated());
        else :
            $variation = Variation::create($request->validated());
        endif;

        FileUploadTrait::uploadMultipleFiles($request->images ? $request->images : [], $variation, 'variations');
        DB::commit();
        $response = ['status' => true, 'message' => 'Variation updated successfully.'];
        return $response;
    }



    public static function detail(int $id)
    {
        $product = Product::findOrFail($id);
        $product->load(['images', 'variations.media']);
        $sub_categories = SubCategory::where('category_id', $product->category_id)->cursor();
        return ['product' => $product, 'sub_categories' => $sub_categories];
    }
}
