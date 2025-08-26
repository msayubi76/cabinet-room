<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductVariationRequest;
use App\Models\Variation;
use App\Services\CategoryService;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductService::getproducts();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $category = Category::all();
        return view('admin.product.create', compact('category'));
    }

    public function store(ProductRequest $request)
    {
        try {
            ProductService::store($request); 
            return redirect(route('products.index'))->with('success', 'Product added successfully.');
        } catch (\Throwable $th) { 
            return redirect(route('products.index'))->with('error', $th->getMessage());
        }
    }
    public function edit($id)
    {

        $product_data = ProductService::detail($id);
        $category = CategoryService::getCategory();
        $variations = $product_data['product']->variations;
        $product_data['category'] = $category;
        $product_data['variations'] = $variations;


        return view('admin.product.edit', $product_data);
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product_response = ProductService::update($request, $product);
            return redirect(route('products.index'))->with('success', 'Product updated successfully.');
        } catch (\Throwable $th) {
            return redirect(route('products.index'))->with('error', $th->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $product_response = ProductService::destroy($id);
            return $product_response;
        } catch (\Throwable $th) {
            return redirect(route('products.index'))->with('error', $th->getMessage());
        }
    }

    public function getSubCategory(Request $request)
    {
        // return $request;
        return SubCategory::where('category_id', $request->id)->get();
    }

    public function updateVariation(ProductVariationRequest $request, Variation $variation = null)
    {
        try {
            $res = ProductService::updateVariation($request, $variation);
            return $res;
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function destroyVariation(Variation $variation)
    {
        try {
            $variation->delete();
            return response()->json(['status' => true, 'message' => 'Variation deleted successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }
}
