<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Services\SubCategoryService;
use App\Http\Requests\SubCategoryRequest;
use App\Services\CategoryService;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories = SubCategoryService::getSubCategory();
        $category = CategoryService::getCategory();

        return view('admin.subcategory.index', compact('sub_categories', 'category'));
    }

    public function store(SubCategoryRequest $request)
    {
        try {
            $sub_category_response = SubCategoryService::store($request);
            return $sub_category_response;
        } catch (\Throwable $th) {
              return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }



    public function update(SubCategoryRequest $request, SubCategory $subcategory)
    {
        try {
            $sub_category_response = SubCategoryService::update($request, $subcategory);
            return $sub_category_response;
        } catch (\Throwable $th) {
              return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try {
            $sub_category_response = SubCategoryService::destroy($id);
            return $sub_category_response;
        } catch (\Throwable $th) {
              return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }
}
