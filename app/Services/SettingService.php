<?php

namespace App\Services;



use App\Models\Setting;
use Illuminate\Support\Facades\DB;


use App\Http\Requests\SettingRequest;

class SettingService
{
    public static function getSetting(){
        return Setting::first();
    }


 

    public static function update(SettingRequest $request){
        $data = $request->validated(); 
        $setting = Setting::first();
       
        if(!$setting):
            $setting = Setting::create($data); 
        else:
            $setting->update($data); 
        endif; 
        return $setting;
    }

   



}
