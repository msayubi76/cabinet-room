<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Services\BannerService;
use App\Http\Requests\BannerRequest;

class BannerController extends Controller
{
    public function index()
    {
            $banners = BannerService::getBanners();

            return view('admin.Banner.index',compact('banners'));


    }
    public function create()
    {

        return view('admin.Banner.create');
    }

    public function store(BannerRequest $request){
        try {

            $banner_response = BannerService::store($request);

            return redirect(route('banners.index'))->with('success', 'Banner added successfully.');
        } catch (\Throwable $th) {
            return redirect(route('banners.index'))->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {

        $banner = Banner::FindorFail($id);





        return view('admin.Banner.edit', compact('banner'));
    }

    public function update(BannerRequest $request, Banner $banner){
        try {

           $banner_response = BannerService::update($request,$banner);
           return redirect(route('banners.index'))->with('success', 'Banner updated successfully.');
        } catch (\Throwable $th) {
            return redirect(route('banners.index'))->with('error', $th->getMessage());
        }
    }
    public function destroy($id){
       try {
            $banner_response = BannerService::destroy($id);
            return $banner_response;
       } catch (\Throwable $th) {
           return response()->json(['status' => false, 'message' => $th->getMessage()]);
       }
    }

}
