<?php

namespace App\Services;



use App\Models\Category;
use Illuminate\Support\Facades\DB;

use App\Traits\FileUploadTrait;
use App\Http\Requests\CategoryRequest;

class CategoryService
{
    public static function getCategory(){
        return Category::orderBy('id', 'DESC')->paginate(30);
    }

    public static function store(CategoryRequest $request)
    {

        DB::beginTransaction();
        $data = $request->validated();


        if ($request->hasFile('category_image')) :
            $image_name = FileUploadTrait::fileUpload($request->category_image, 'categories');

            $data['folder_name'] = 'categories';
            $data['image_name'] =  $image_name;
            $data['image_url'] = url('/storage/categories/' . $image_name);
        endif;
        $data['is_active'] =  $request->is_active == true ? '1' : '0';

        $category = Category::create($data);

        DB::commit();
        $response = ['status' => true, 'message' => 'Category added successfully.', 'category' => $category];

        return $response;
    }

    public static function update(CategoryRequest $request, Category $category){

        DB::beginTransaction();
        $data = $request->validated();
        if ($request->hasFile('category_image')) :
            $image_name = FileUploadTrait::fileUpload($request->category_image, 'categories');

            $data['folder_name'] = 'categories';
            $data['image_name'] =  $image_name;
            $data['image_url'] = url('/storage/categories/' . $image_name);
        endif;
        $data['is_active'] =  $request->is_active == true ? '1' : '0';



        $category->update($data);


        DB::commit();
        $response = ['status' => true, 'message' => 'Category updated successfully.', 'category' => $category];
        return $response;
    }

    public static function destroy($id)
    {
        DB::beginTransaction();
        $category = Category::FindorFail($id);
        // $category->subcategories()->delete();
        // $category->products()->delete();

        $category->delete();
        DB::commit();
        $response = ['status' => true, 'message' => 'Category removed with sub category and realted Products successfully.'];
        return $response;
    }



}
