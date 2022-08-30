<?php

namespace App\Services;



use App\Models\Setting;
use Illuminate\Support\Facades\DB;


use App\Http\Requests\SettingRequest;

class SettingService
{
    public static function getSetting(){
        return Setting::orderBy('id', 'DESC')->paginate(30);
    }



    public static function store($request)
    {

        DB::beginTransaction();
        $data = $request->validated();



        $setting = Setting::create($data);

        DB::commit();
        $response = ['status' => true, 'message' => 'page added successfully.', 'setting' => $setting];

        return $response;
    }

    public static function update(SettingRequest $request, Setting $setting){
        DB::beginTransaction();
        $data = $request->validated();


        $setting->update($data);


        DB::commit();
        $response = ['status' => true, 'message' => 'pages updated successfully.', 'setting' => $setting];
        return $response;
    }

    // public static function destroy($id)
    // {
    //     DB::beginTransaction();
    //     $setting = Category::FindorFail($id);
    //     // $setting->subcategories()->delete();
    //     // $setting->products()->delete();

    //     $setting->delete();
    //     DB::commit();
    //     $response = ['status' => true, 'message' => 'Category removed with sub category and realted Products successfully.'];
    //     return $response;
    // }



}
