<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $categories = CategoryService::getCategory();

            return view('admin.category.index',compact('categories'));


    }

    public function store(CategoryRequest $request){

        try {

            $category_response = CategoryService::store($request);

            return $category_response;

        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }



    public function update(CategoryRequest $request, Category $category){

        try {

           $category_response = CategoryService::update($request,$category);
           return $category_response;
        } catch (\Throwable $th) {
           return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }
    public function destroy($id){
       try {
            $category_response = CategoryService::destroy($id);
            return $category_response;
       } catch (\Throwable $th) {
           return response()->json(['status' => false, 'message' => $th->getMessage()]);
       }
    }



}
