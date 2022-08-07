<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sub_Category;
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
        $category = Category::get();

        return view('admin.subcategory.index', compact('categories', 'category'));
    }

    public function store(SubCategoryRequest $request)
    {
        try {
            $sub_category_response = SubCategoryService::store($request);
            return $sub_category_response;
        } catch (\Throwable $th) {
            return $th;
        }
    }



    public function update(SubCategoryRequest $request, Sub_Category $subcategory)
    {
        try {
            $sub_category_response = SubCategoryService::update($request, $subcategory);
            return $sub_category_response;
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function destroy($id)
    {
        try {
            $sub_category_response = SubCategoryService::destroy($id);
            return $sub_category_response;
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
