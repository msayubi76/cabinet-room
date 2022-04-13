<?php

namespace App\Http\Controllers;
 
use App\Models\GeneralSetting  ;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralSettingController extends Controller
{
    use FileUploadTrait;
    public function __construct()
    {
        $this->middleware('auth'); 
        // $this->middleware(['role_or_permission:Super Admin'], ['only'=>['index', 'update']]);
            
    } 

    public function index()
    {
        $generalSetting =GeneralSetting::first(); 
        return view('setting.setting', compact('generalSetting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GeneralSetting  $generalSetting
     * @return \Illuminate\Http\Response
     */
    public function show(GeneralSetting $generalSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GeneralSetting  $generalSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(GeneralSetting $generalSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GeneralSetting  $generalSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    { 
        try {
            DB::beginTransaction();
            $data = $request->except('_token', '_method');
            $setting = GeneralSetting::find(decrypt($id));
            if($request->hasFile('ceo_image')):
                $data['ceo_image'] = $this->fileUpload($request->ceo_image, 'users');
                if($setting->ceo_image):
                    $this->fileDeleted($setting->ceo_image, 'users');
                endif; 
            endif;
            if($request->hasFile('df_image')):
                $data['df_image'] = $this->fileUpload($request->df_image, 'users');
                if($setting->df_image):
                    $this->fileDeleted($setting->df_image, 'users');
                endif; 
            endif;
            if($request->hasFile('coordinator_image')):
                $data['coordinator_image'] = $this->fileUpload($request->coordinator_image, 'users');
                if($setting->coordinator_image):
                    $this->fileDeleted($setting->coordinator_image, 'users');
                endif; 
            endif;
            if($request->hasFile('hirose_president_image')):
                $data['hirose_president_image'] = $this->fileUpload($request->hirose_president_image, 'users');
                if($setting->hirose_president_image):
                    $this->fileDeleted($setting->hirose_president_image, 'users');
                endif; 
            endif;  

            $setting->update($data);
            DB::commit();
            return redirect()->back()->with('success', "Setting updated.");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GeneralSetting  $generalSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(GeneralSetting $generalSetting)
    {
        //
    }
}
