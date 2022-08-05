<?php

namespace App\Services;




use App\Models\Category;

use App\Models\Sub_Category;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SubCategoryRequest;


class SubCategoryService
{
    public static function getSubCategory(){

            $sub_category = Sub_Category::orderBy('id', 'DESC')->paginate(30);

            return $sub_category  ;

    }

    public static function store(SubCategoryRequest $request)
    {
        DB::beginTransaction();
        $data = $request->validated();

        if ($request->hasFile('profile')) :
            $image_name = FileUploadTrait::fileUpload($request->profile, 'profile');

            $data['folder_name'] = 'profile';
            $data['image_name'] =  $image_name;
            $data['image_url'] = url('/storage/subcategory/' . $image_name);
        endif;
        $data['is_active'] =  $request->is_active == true ? '1' : '0';
        $data['category_d'] = $request->category_id;

        $subcategory = Sub_Category::create($data);
        DB::commit();
        $response = ['status' => true, 'message' => 'SubCategory added successfully.', 'subcategory' => $subcategory];

        return $response;
    }

    public static function update(SubCategoryRequest $request, Sub_Category $subcategory){
        DB::beginTransaction();
        $data = $request->validated();
        $subcategory->update($data);
        DB::commit();
        $response = ['status' => true, 'message' => ' SubCategory updated successfully.', 'subcategory' => $subcategory];
        return $response;
    }

    public static function destroy($id)
    {
        DB::beginTransaction();
        $subcategory = Sub_Category::findorFail($id);
        $subcategory->delete();
        $subcategory->products()->delete();
        DB::commit();
        $response = ['status' => true, 'message' => 'Subcategory removed with related Products successfully.'];
        return $response;
    }



}
