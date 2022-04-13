<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Quote;
use App\Models\SubCategory;
use App\Models\Transaction;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Testing\MimeType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
     use FileUploadTrait;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:product.list',['only'=>['index']]); 
        $this->middleware('permission:product.create', ['only' => ['create','store']]);
        $this->middleware('permission:product.update', ['only' => ['edit','update']]);
        $this->middleware('permission:product.delete', ['only' => ['destroy']]);
         

        $this->middleware(['role_or_permission:Customer|Super Admin|product.view'], ['only'=>['show']]);
    } 
    public function index()
    {
        $list=Product::all(); 
        return view('product/index',compact('list'));
    }
 
    public function create()
    { 
        $categories = Category::all();
        $countries = Config::get('countries.countries');
        
        return view('product/create', compact('categories','countries'));
    }
 
    public function store(Request $request)
    { 
        $this->validate($request,[
            'category_id'=>'required',
            'sub_category_id'=>'required',
            'purchase_price'=>'required|numeric',
            'price'=>'required|numeric',
            'files'=>'required',
            'currency_type'=>'required',
        ],[
            'category_id.required' => 'Please select category.',
            'sub_category_id.required' => 'Please select sub category.',
            'price.required' => 'Sale price is required.',
            'files.required' => 'Please upload car image.',
        ]);
      
        try{
            DB::beginTransaction();
 
            $data = $request->except('_token');
            $data['category_id'] = $request->category_id;
            

            if ($request->hasFile('feature_image')){
                $data['feature_image']  =  $this->fileUpload( $request->file('feature_image'),'feature_image' ); 
            }
            $product =  Product::create($data);
            
            
            if ($request->hasFile('files')){
                $image_path =  $this->uploadMultipleFiles( $request->file('files'), $product->id, 'products' ); 
            }
            
            $chesis_no= sprintf('Ch-%04d', $product->id);
            $product->update(['chassis_no' => $chesis_no]);

            DB::commit();
            return redirect('product')->with('success','Product Created Successfully');
        }catch (\Exception $e){
            DB::rollback(); 
            return redirect('product')->with('error',$e->getMessage());
        }
    }

     
 
    public function show($id)
    {
        $id=decrypt($id);
        $product= Product::find($id);
        
        $files = $product->getMedia($id, 'products');
        if ($product instanceof \Exception) {
            return redirect('product')->with('error',$product->getMessage());
        }
        if ($product) { 
            return view('product.view', compact('product', 'files'));
        }
        return redirect('product')->with('error', "Product not exist"); 
    }

   
    public function edit($id)
    {
        $id=decrypt($id);
        $product= Product::find($id);
        $categories = Category::all();
        $countries = Config::get('countries.countries');
        $files = $product->getMedia($id, 'products');
        
        $sub_categories = SubCategory::where('category_id', $product->category_id)->get();
        if ($product instanceof \Exception) {
            return response()->json(['status' => false, 'success' =>false, 'msg' => $product->getMessage()]);
        }
        if ($product) { 
            return view('product.edit', compact('product', 'categories', 'sub_categories', 'countries', 'files'));
        }
        return redirect('product')->with('error', "Product not exist"); 
    }
 
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'category_id'=>'required',
            'sub_category_id'=>'required',
            'purchase_price'=>'required',
            'price'=>'required',
           
        ],[
            'category_id.required' => 'Please select category.',
            'sub_category_id.required' => 'Please select sub category.',
            'price.required' => 'Sale price is required.',
        ]);

        $id=decrypt($id); 
        try {
            DB::beginTransaction();
            $product = Product::find($id);

            $data = $request->except('_token', '_method');

            $current_files=false;
            
            if ($request->hasFile('files')){
                 $this->uploadMultipleFiles( $request->file('files'), $product->id, 'products', 'update' ); 
            }

            if ($request->hasFile('feature_image')){
                $data['feature_image']  =  $this->fileUpload( $request->file('feature_image'),'feature_image' ); 
                if($product->feature_image):
                    $this->fileDeleted($product->feature_image, 'feature_image');
                endif;
            }

            $prev_files=array();
            if($current_files):
                if($product->id ):
                       $prev_files = json_decode($product->image);
                endif;
                if($prev_files == null ):
                    $prev_files=array();
                endif; 
                foreach ($current_files as $file ) { 
                    array_push($prev_files, ['name'=>$file['name'], 'file_type'=>$file['file_type'], 'extension'=>$file['extension']]);
                }
                   $data['image']  = json_encode($prev_files);
            endif;

            
            
 

            $product = $product->update($data);

            DB::commit();
            return redirect('product')->with('success', "Product has been updated");
        }catch (\Exception $e){
            DB::rollback();
            return redirect('product')->with('error', $e->getMessage()); 
        }
    }
 
    public function destroy($id)
    {

        try{
            DB::beginTransaction();
            $id=decrypt($id);
            $item=Product::find($id);
            $item->delete();
            DB::commit();
            return response()->json(['status' => true, 'success' =>true, 'msg' => 'Product Deleted Successfully']);

        }catch (\Exception $e){
            DB::rollback(); 
            return response()->json(['status' => false, 'success' =>false, 'msg' =>  $e->getMessage()]);
        }
    }
 


}
