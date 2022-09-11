<?php
namespace App\Services;
use App\Models\Category;

use App\Models\SubCategory;

use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SubCategoryRequest;
class SubCategoryService {
    public static function getSubCategory(){

            $sub_category = SubCategory::orderBy('id', 'DESC')->paginate(30);

            return $sub_category  ;

    }

    public static function store(SubCategoryRequest $request)
    {

        DB::beginTransaction();
        $data = $request->validated();

        if ($request->hasFile('sub_category_image')) :
            $image_name = FileUploadTrait::fileUpload($request->sub_category_image, 'sub_categories');

            $data['folder_name'] = 'sub_categories';
            $data['image_name'] =  $image_name;
            $data['image_url'] = url('/storage/sub_categories/' . $image_name);
        endif;
        $data['is_active'] =  $request->is_active == true ? '1' : '0';
        $data['category_d'] = $request->category_id;

        $subcategory = SubCategory::create($data);
        $subcategory->load(['category']);
        DB::commit();
        $response = ['status' => true, 'message' => 'Sub category added successfully.', 'sub_category' => $subcategory];

        return $response;
    }

    public static function update(SubCategoryRequest $request, SubCategory $subcategory){

        DB::beginTransaction();
        $data = $request->validated();
        if ($request->hasFile('sub_category_image')) :
            $image_name = FileUploadTrait::fileUpload($request->sub_category_image, 'sub_categories');

            $data['folder_name'] = 'sub_categories';
            $data['image_name'] =  $image_name;
            $data['image_url'] = url('/storage/sub_categories/' . $image_name);
        endif;
        $data['is_active'] =  $request->is_active == true ? '1' : '0';
        $data['category_d'] = $request->category_id;


        $subcategory->update($data);
        $subcategory->load(['category']);
        DB::commit();
        $response = ['status' => true, 'message' => ' Sub category updated successfully.', 'sub_category' => $subcategory];
        return $response;
    }

    public static function destroy($id)
    {
        DB::beginTransaction();
        $subcategory = SubCategory::findorFail($id);
        $subcategory->delete();
        $subcategory->products()->delete();
        DB::commit();
        $response = ['status' => true, 'message' => 'Subcategory removed with related Products successfully.'];
        return $response;
    }


}
