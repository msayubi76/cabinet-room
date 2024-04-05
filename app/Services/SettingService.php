<?php

namespace App\Services;



use App\Models\Setting;
use App\Models\Banner;
use Illuminate\Support\Facades\DB;


use App\Http\Requests\SettingRequest;
use App\Http\Requests\BannerRequest;
use App\Traits\FileUploadTrait;

class SettingService
{
    public static function getSetting()
    {
        return Setting::firstOrCreate();

        return Setting::first();
    }

    public static function getProductBanner()
    {
        return Banner::where('page_name', 'products')->first();
    }

    public static function getSearchBanner()
    {

        return Banner::where('page_name', 'search')->first();
    }



    public static function update(SettingRequest $request)
    {
        $data = $request->validated();
        $setting = Setting::first();
        $productBanner = Banner::where('page_name', 'products')->first();
        $searchBanner = Banner::where('page_name', 'search')->first();
        DB::beginTransaction();
        if ($request->hasFile('product_banner_image')) {
            $image_name = FileUploadTrait::fileUpload($request->product_banner_image, 'banners');

            $product_banner['page_name'] = 'products';
            $product_banner['name'] = 'Products Page Banner';
            $product_banner['folder_name'] = 'banners';
            $product_banner['image_name'] =  $image_name;
            $product_banner['image_url'] = url('/storage/banners/' . $image_name);
           
            if (!$productBanner) {
                $banner = Banner::create($product_banner);
            } else {
                $productBanner->update($product_banner);
            }
        }
        if ($request->hasFile('search_banner_image')) {
            $image_name = FileUploadTrait::fileUpload($request->search_banner_image, 'banners');
            $search_banner['page_name'] = 'search';
            $search_banner['name'] = 'Search Page Banner';
            $search_banner['folder_name'] = 'banners';
            $search_banner['image_name'] =  $image_name;
            $search_banner['image_url'] = url('/storage/banners/' . $image_name);
            
            if (!$searchBanner) {
                $banner = Banner::create($search_banner);
            } else {
                $searchBanner->update($search_banner);
            }
        }
        if (!$setting) :
            $setting = Setting::create($data);
        else :
            $setting->update($data);
        endif;
        DB::commit();

        return $setting;
    }
}
