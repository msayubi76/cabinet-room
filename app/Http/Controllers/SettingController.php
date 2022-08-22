<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Services\SettingService;
use App\Http\Requests\SettingRequest;

class SettingController extends Controller
{
    public function index(){

        $setting = SettingService::getAboutSetting();


        return view('admin.setting.about-index', compact('setting'));
    }
    public function contactIndex(){

        $setting = SettingService::getContactSetting();


        return view('admin.setting.contact-index', compact('setting'));
    }
    // public function privacyIndex(){

    //     $setting = SettingService::getPrivacySetting();


    //     return view('admin.setting.privacy-index', compact('setting'));
    // }
    public function create()
    {

        return view('admin.setting.create');
    }
    public function store(SettingRequest $request)
    {
        try {
            $setting_response = SettingService::store($request);
            return $setting_response;
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function edit($id)
    {

        $setting = Setting::findOrFail($id);





        return view('admin.setting.edit',compact('setting'));
    }

}
