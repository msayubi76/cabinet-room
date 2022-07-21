<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Services\SubCategoryService;
use App\Http\Requests\SubCategoryRequest;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $categories = SubCategoryService::getSubCategory();
            $category = Category::where('is_active','0')->get();
            return view('admin.subcategory.index',compact('categories','category'));


    }

    public function store(SubCategoryRequest $request){
        try {
            $subcategory_obj = new SubCategoryService;
            $subcategory_response = $subcategory_obj->store($request);
            return $subcategory_response;

        } catch (\Throwable $th) {
            return $th;
        }
    }



    public function update(SubCategoryRequest $request, SubCategory $subcategory){
        try {
           $subcategory_obj = new SubCategoryService;
           $subcategory_response = $subcategory_obj->update($request,$subcategory);
           return $subcategory_response;
        } catch (\Throwable $th) {
           return $th;
        }
    }
    public function destroy($id){
       try {
            $subcategory_response = SubCategoryService::destroy($id);
            return $subcategory_response;
       } catch (\Throwable $th) {
           return $th;
       }
    }
}
