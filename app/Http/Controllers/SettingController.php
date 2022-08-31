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


        try {
            $setting_response = SettingService::store($request);
            return redirect(route('settings.index'))->with('success', 'Pages added successfully.');
        } catch (\Throwable $th) {
            return redirect(route('settings.index'))->with('error', $th->getMessage());
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

            return redirect('admin/settings/1/edit')->with('success', 'Pages updated successfully.');
        } catch (\Throwable $th) {
            return redirect('admin/settings/1/edit')->with('error', $th->getMessage());
        }
    }
}
