<?php

namespace App\Services;



use App\Models\Category;
use Illuminate\Support\Facades\DB;

use App\Traits\FileUploadTrait;
use App\Http\Requests\CategoryRequest;

class CategoryService
{
    public static function getCategory(){

            $category = Category::orderBy('id', 'DESC')->paginate(30);
            return $category;

    }

    public function store(CategoryRequest $request)
    {
        DB::beginTransaction();
        $data = $request->validated();
        // if ($request->hasFile('image')) :
        //     $image_name = $this->fileUpload($request->image, 'image');
        //     $data['folder_name'] = 'image';
        //     $data['image_name'] =  $image_name;
        //     $data['image_url'] = url('/storage/image/' . $image_name);
        // endif;
        $data['is_active'] = $request->is_active == true ? '1':'0';

        $category = Category::create($data);
        DB::commit();
        $response = ['status' => true, 'message' => 'category added successfully.', 'category' => $category];

        return $response;
    }

    public function update(CategoryRequest $request, Category $category){
        DB::beginTransaction();
        $data = $request->validated();

        $category->update($data);


        DB::commit();
        $response = ['status' => true, 'message' => ' category updated.', 'category' => $category];
        return $response;
    }

    public static function destroy($id)
    {
        DB::beginTransaction();
        $category = Category::findorFail($id);
        $category->delete();
        DB::commit();
        $response = ['status' => true, 'message' => 'category removed successfully.'];
        return $response;
    }

}
