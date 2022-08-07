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
    public function index()
    {
        $product = ProductService::getproducts();
        return view('admin.product.index', compact('product'));
    }

    public function create()
    {
        $category = Category::all();
        return view('admin.product.create', compact('category'));
    }

    public function store(ProductRequest $request)
    {
        try {
            $product_response = ProductService::store($request);
            return $product_response;
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::all();

        return view('admin.product.edit', compact('product', 'category'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product_response = ProductService::update($request, $product);
            return $product_response;
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function destroy($id)
    {
        try {
            $product_response = ProductService::destroy($id);
            return $product_response;
        } catch (\Throwable $th) {
            return $th;
        }
    }


    public function getSubCategory(Request $request)
    {
        // return $request;
        return Sub_Category::where('category_id', $request->id)->get();
    }
}
