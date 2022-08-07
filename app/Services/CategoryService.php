<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Traits\FileUploadTrait;
use App\Http\Requests\CategoryRequest;

class CategoryService
{

    public static function getCategory()
    {
        $category = Category::orderBy('id', 'DESC')->paginate(30);
        return $category;
    }

    public static function update(CategoryRequest $request, Category $category)
    {
        DB::beginTransaction();
        $data = $request->validated();

        $category->update($data);


        DB::commit();
        $response = ['status' => true, 'message' => ' category updated successfully.', 'category' => $category];
        return $response;
    }


    public static function store(CategoryRequest $request)
    {
        DB::beginTransaction();
        $data = $request->validated();
        if ($request->hasFile('profile')) :
            $image_name = FileUploadTrait::fileUpload($request->profile, 'profile');
            $data['folder_name'] = 'profile';
            $data['image_name'] =  $image_name;
            $data['image_url'] = url('/storage/category/' . $image_name);
        endif;
        // $data['is_active'] =  $request->is_active == true ? '1' : '0';
        $category = Category::create($data);
        DB::commit();
        $response = ['status' => true, 'message' => 'category added successfully.', 'category' => $category];
        return $response;
    }




}
