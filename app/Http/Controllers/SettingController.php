<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Services\SettingService;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {

        $setting = SettingService::getSetting();

        return view('admin.setting.index', compact( 'setting'));
    }
    public function create(){


        return view('admin.setting.create' );
    }

    public function store(SettingRequest $request){

        dd($request);
        try {
            $setting_response = SettingService::store($request);
            return $setting_response;
        } catch (\Throwable $th) {
            return $th;
        }


    }
    public function edit($id){
        $setting = Setting::FindorFail($id);

        return view('admin.setting.edit',compact('setting') );
    }
    public function update(SettingRequest $request, Setting $setting)
    {

        try {
            $setting_response = SettingService::update($request, $setting);

            return $setting_response;
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
