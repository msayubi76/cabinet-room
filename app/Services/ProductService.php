<?php
namespace App\Services;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProductRequest;
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

        $product = Product::create($data);
        DB::commit();

        $response = ['status' => true, 'message' => 'product added successfully.', 'product' => $product];
        return $response;
        // return redirect('admin/products')->with('success', 'product added successfully');
        // return redirect()->route('admin/products')->with($response);



    }

    public static function update(ProductRequest $request, Product $product){
        DB::beginTransaction();
        $data = $request->validated();

        $product->update($data);
    }
}
