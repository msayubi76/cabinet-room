<?php

namespace App\Services;



use App\Models\Banner;
use Illuminate\Support\Facades\DB;

use App\Traits\FileUploadTrait;
use App\Http\Requests\BannerRequest;

class BannerService
{
    public static function getBanners(){
        return Banner::orderBy('id', 'DESC')->paginate(30);
    }

    public static function store(BannerRequest $request)
    {

        DB::beginTransaction();
        $data = $request->validated();


        if ($request->hasFile('banner_image')) :
            $image_name = FileUploadTrait::fileUpload($request->banner_image, 'banners');

            $data['folder_name'] = 'banners';
            $data['image_name'] =  $image_name;
            $data['image_url'] = url('/storage/banners/' . $image_name);
        endif;


        $banner = Banner::create($data);

        DB::commit();
        $response = ['status' => true, 'message' => 'Banner added successfully.', 'banner' => $banner];

        return $response;
    }

    public static function update(BannerRequest $request, Banner $banner){
        DB::beginTransaction();
        $data = $request->validated();

        $banner->update($data);


        DB::commit();
        $response = ['status' => true, 'message' => 'Banner updated successfully.', 'banner' => $banner];
        return $response;
    }

    public static function destroy($id)
    {
        DB::beginTransaction();
        $banner = Banner::FindorFail($id);
        // $category->subcategories()->delete();
        // $category->products()->delete();

        $banner->delete();
        DB::commit();
        $response = ['status' => true, 'message' => 'Banner removed  successfully.'];
        return $response;
    }



}
