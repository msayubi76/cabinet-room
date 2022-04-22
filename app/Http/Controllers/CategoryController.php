<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
 
class CategoryController extends Controller
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
        $this->middleware('permission:category.list',['only'=>['index']]); 
        $this->middleware('permission:category.create', ['only' => ['create','store']]);
        $this->middleware('permission:category.update', ['only' => ['edit','update',' editCategory','updateCategory']]);
        $this->middleware('permission:category.delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category=Category::all();
        return view('category/category',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $this->validate($request,[
            'name'=>'required|max:100|min:3|unique:categories',
            'image'=>'nullable|mimes:jpeg,jpg,png,gif|max:10000',
            'detail'=>'nullable|max:200',
        ]);
        try{

            DB::beginTransaction();
            $data=$request->all();

            if($request->hasFile('image')){
               $data['image'] = $this->fileUpload($request->file('image'), 'categories');
            }

            $category = Category::create($data);
            DB::commit();
            $category = $category->setAttribute('item_id', encrypt($category->id));
            return redirect('category')->with('success', "Category has been created");
            return response()->json(['status' => true, 'success' =>true, 'category' => $category, 'msg' => "Category has been Created"]);
        }catch (\Exception $e){
            DB::rollback();
            return response()->json(['status' => false, 'success' =>false, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editCategory($id)
    {
        $id = decrypt($id);

        

        $category= Category::find($id); 
        if ($category instanceof \Exception) {
            return response()->json(['status' => false, 'success' =>false, 'msg' => $category->getMessage()]);
        }
        if ($category) { 
            return response()->json(['status' => true, 'success' =>true, 'category' => $category]); 
        }
        return response()->json(['status' => true, 'success' =>true, 'msg' => "Category not exist"]);
    }

   
    public function updateCategory(Request $request)
    {
        
        $id = $request->id;
        $attri =$this->validate($request, [
            'name' => 'required|max:100|min:2|'.Rule::unique('categories')->ignore($id),
            'image'=>'nullable|mimes:jpeg,jpg,png,gif|max:10000',
            'detail'=>'nullable|max:200',
        ]);
  
        try {
            DB::beginTransaction();
            if($request->hasFile('image')){
                if($request->old_image):
                    $image_path = public_path().'/site_images/categories/'.$request->old_image;
                    unlink($image_path);
                endif;
                $attri['image'] = $this->fileUpload($request->file('image'), 'categories');
            }

            $Category = Category::find($id);
            $Category->update($attri);
            $Category = Category::find($id);

         
            
            DB::commit();
            return response()->json(['status' => true, 'success' =>true, 'category'=>$Category, 'msg' => 'Category has been updated']);
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
            $id = decrypt($id);
            $CatDelete=Category::find($id);
            $CatDelete->delete();
            DB::commit();
            return redirect('category')->with('success','Category Deleted Successfully');
        }catch (\Exception $e){
            DB::rollback();
            return redirect(url('category'))->with('error',$e->getMessage());
        }

    }
}
