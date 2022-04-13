<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JdmParts;
use App\Models\Product;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JdmPartsController extends Controller
{
    use FileUploadTrait;
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:jdm_part.list',['only'=>['index']]); 
        $this->middleware('permission:jdm_part.create', ['only' => ['create','store']]);
        $this->middleware('permission:jdm_part.update', ['only' => ['edit','update']]);
        $this->middleware('permission:jdm_part.delete', ['only' => ['destroy']]);
      
    }
     
    public function index()
    {
        $jdm_parts=JdmParts::all(); 
        return view('jdm_part/index',compact('jdm_parts'));
    }

   
    public function create()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('jdm_part/create', compact('categories', 'products'));
    }

   
    public function store(Request $request)
    {  
        try{
            DB::beginTransaction(); 
            $data = $request->except('_token');
            if($request->hasFile('feature_image')){
                $data['feature_image'] = $this->fileUpload($request->file('feature_image'), 'feature_image');
             }
             
            $jdm_part =  JdmParts::create($data);
            if($request->hasFile('images')){
                $images = $this->uploadMultipleFiles($request->file('images'),$jdm_part->id , 'jdm_parts');
             } 
            
            DB::commit(); 
            return redirect('jdm_part')->with('success', "Jdm Part has been created");
        }catch (\Exception $e){
            DB::rollback(); 
            return response()->json(['status' => false, 'success' =>false, 'msg' => $e->getMessage()]);
        }
    }

   


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id); 
        $jdm_part= JdmParts::findOrFail($id); 
        $products = Product::all();
        $categories = Category::all();
        $images = $jdm_part->getMedia($id, 'jdm_parts');
 
         
         return view('jdm_part/edit', compact('jdm_part', 'categories', 'products', 'images'));  
    }
    public function show($id)
    {
        $id = decrypt($id); 
        $jdm_part= JdmParts::findOrFail($id); 
        $part_category = $jdm_part->getCategory; 
        $images = $jdm_part->getMedia($id, 'jdm_parts');
 
         
         return view('jdm_part/show', compact('jdm_part', 'images', 'part_category'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $id = decrypt($id);
            $jdm_part = JdmParts::find($id);
            $attri= $request->all();
            

            if($request->hasFile('feature_image')){
                $attri['feature_image'] = $this->fileUpload($request->file('feature_image'), 'feature_image');
                if($jdm_part->feature_image):
                    $this->fileDeleted($jdm_part->feature_image, 'jdm_parts'); 
                endif;
             }
              
            if($request->hasFile('images')){
                $images = $this->uploadMultipleFiles($request->file('images'),$jdm_part->id , 'jdm_parts');
             }
           
            $jdm_part->update($attri); 
            
            DB::commit();
            
            return redirect('jdm_part')->with('success', 'Jdm Part has been updated'); 
        }catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try{
            DB::beginTransaction();
            $id=decrypt($id);
            $CatDelete=JdmParts::find($id);
            $CatDelete->delete();
            DB::commit();
            return response()->json(['status' => true, 'success' =>true, 'msg' => 'Jdm Part Deleted Successfully']);

        }catch (\Exception $e){
            DB::rollback(); 
            return response()->json(['status' => false, 'success' =>false, 'msg' =>  $e->getMessage()]);
        }
    }
}
