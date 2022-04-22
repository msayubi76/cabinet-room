<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller
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
        $this->middleware('permission:sub_category.list',['only'=>['index']]); 
        $this->middleware('permission:sub_category.create', ['only' => ['create','store']]);
        $this->middleware('permission:sub_category.update', ['only' => ['edit','update', 'editSubCategory','updateSubCategory']]);
        $this->middleware('permission:sub_category.delete', ['only' => ['destroy']]);
      
    }
     
    public function index()
    {
        $sub_categories=SubCategory::all();
        $categories = Category::all();
        return view('sub_category/sub_category',compact('sub_categories','categories'));
    }

   
    public function create()
    {
        $categories = Category::all();
        return view('sub_category/create', compact('categories'));
    }

   
    public function store(Request $request)
    {

       
        $this->validate($request,[
            'name'=>'required|max:100', 
            'category_id'=>'required|max:100', 
        ]);

          
        try{
            DB::beginTransaction(); 
            $data = $request->except('_token');
            if($request->hasFile('image')){
                $data['image'] = $this->fileUpload($request->file('image'), 'sub_categories');
               
             }
 
            $sub_category =  SubCategory::create($data);
            DB::commit();
            $category = $sub_category->setAttribute('item_id', encrypt($sub_category->id));
            $category->getCategory;

            return redirect('sub_category')->with('success', "Sub Category has been created");
             
            return response()->json(['status' => true, 'success' =>true, 'category' => $category, 'msg' => "Sub Category has been Created"]); 
        }catch (\Exception $e){
            DB::rollback();
            return response()->json(['status' => false, 'success' =>false, 'msg' => $e->getMessage()]);
        }
    }

   
    public function getSubCategories($id)
    {
        $items = SubCategory::where('category_id', $id)->get(); 
        if ($items instanceof \Exception) {
            return response()->json(['status' => false, 'success' =>false, 'msg' => $items->getMessage()]);
        }
        $html = "<option value=''>Select Sub Category</option>";

        foreach ($items as $item) {
            $html .= "<option value='$item->id'>$item->name</option>";
        }
 
        if ($items) { 
            return response()->json(['status' => true, 'success' =>true, 'html' => $html]); 
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editSubCategory($id)
    {
        $id = decrypt($id);

        $category= SubCategory::find($id); 
        if ($category instanceof \Exception) {
            return response()->json(['status' => false, 'success' =>false, 'msg' => $category->getMessage()]);
        }
        if ($category) { 
            return response()->json(['status' => true, 'success' =>true, 'category' => $category]); 
        }
        return response()->json(['status' => true, 'success' =>true, 'msg' => "Sub Category not exist"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 
    public function updateSubCategory(Request $request)
    {
        $id = $request->id;
        $attri =$this->validate($request, [
            'name'=>'required|max:50|min:2',
            'category_id'=>'required|max:50',
            'image'=>'nullable|mimes:jpeg,jpg,png,gif|max:10000',
            'detail'=>'nullable|max:200',
        ]);
  
        try {
            DB::beginTransaction();
            if($request->hasFile('image')){
                
                if($request->old_image):
                    $image_path = public_path().'/site_images/sub_categories/'.$request->old_image;
                    unlink($image_path);
                endif;
                $attri['image'] = $this->fileUpload($request->file('image'), 'sub_categories');
            }
           
           
            $Category = SubCategory::find($id);
            $Category->update($attri);
            $Category = SubCategory::find($id);
            
            DB::commit();
            
            return response()->json(['status' => true, 'success' =>true, 'category'=>$Category, 'msg' => 'Sub Category has been updated']);
        }catch (\Exception $e){
            DB::rollback();
            return response()->json(['status' => false, 'success' =>false, 'msg' => $e->getMessage()]);
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
            $CatDelete=SubCategory::find($id);
            $CatDelete->delete();
            DB::commit();
            return response()->json(['status' => true, 'success' =>true, 'msg' => 'Sub Category Deleted Successfully']);

        }catch (\Exception $e){
            DB::rollback(); 
            return response()->json(['status' => false, 'success' =>false, 'msg' =>  $e->getMessage()]);
        }
    }
}
