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

        // Handle feature image
        if ($request->hasFile('feature_image')) :
            $image_name = FileUploadTrait::fileUpload($request->feature_image, 'products');
            $data['folder_name'] = 'products';
            $data['feature_image_name'] =  $image_name;
            $data['feature_image'] = url('/storage/products/' . $image_name);
        endif;
        // Create product
        $product = Product::create($data);

        // Generate SKU
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
                    // TCS fields
                    "weight" => $variation['weight'] ?? null,
                    "length" => $variation['length'] ?? null,
                    "width" => $variation['width'] ?? null,
                    "height" => $variation['height'] ?? null,
                    "tcs_description" => $variation['tcs_description'] ?? null,
                    "sku" => $variation['sku'] ?? null,
                ];
                
                $var = Variation::create($array);
                
                if (isset($variation['images']) && count($variation['images']) > 0) :
                    $image_name = FileUploadTrait::uploadMultipleFiles($variation['images'], $var, 'variations');
                endif;
            endforeach;
        endif;

        // Handle product images
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
    
        // Handle variations - delete all and create new ones
        if ($request->has('Variation')) {
            // Delete all existing variations
            Variation::where('product_id', $product->id)->delete();
            
            $Variations = $request->Variation;
            
            foreach ($Variations as $key => $variation) :
                $array = [
                    "name" =>  $variation['name'] ?? 'color',
                    "value" => $variation['value'] ?? '',
                    "price" => $variation['price'] ?? 0,
                    "stock" => $variation['stock'] ?? 0,
                    "discount" => $variation['discount'] ?? 0,
                    "sale_price" => $variation['sale_price'] ?? 0,
                    "product_id" => $product->id,
                    // TCS fields
                    "weight" => $variation['weight'] ?? null,
                    "length" => $variation['length'] ?? null,
                    "width" => $variation['width'] ?? null,
                    "height" => $variation['height'] ?? null,
                    "tcs_description" => $variation['tcs_description'] ?? null,
                    "sku" => $variation['sku'] ?? null,
                ];
                
                $var = Variation::create($array);
                
                if (isset($variation['images']) && count($variation['images']) > 0) :
                    $image_name = FileUploadTrait::uploadMultipleFiles($variation['images'], $var, 'variations');
                endif;
            endforeach;
        } else {
            // If no variations are provided, delete all existing variations
            Variation::where('product_id', $product->id)->delete();
        }
    
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
        
        $variationData = $request->validated();
        
        // Add TCS fields to variation data
        $variationData['weight'] = $request->weight ?? null;
        $variationData['length'] = $request->length ?? null;
        $variationData['width'] = $request->width ?? null;
        $variationData['height'] = $request->height ?? null;
        $variationData['tcs_description'] = $request->tcs_description ?? null;
        $variationData['sku'] = $request->sku ?? null;

        if ($variation) :
            $variation->update($variationData);
        else :
            $variation = Variation::create($variationData);
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