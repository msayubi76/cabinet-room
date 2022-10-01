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
    public function edit()
    {
        $setting = SettingService::getSetting(); 
        return view('admin.setting.edit', compact('setting'));
    }

    public function update(SettingRequest $request )
    { 
        try {
           
            SettingService::update($request ); 
            return redirect()->back()->with('success', 'Setting updated successfully.');
        } catch (\Throwable $th) {
            return redirect( )->back()->with('error', $th->getMessage());
        }
    }
}
