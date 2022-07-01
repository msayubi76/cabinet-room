<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Services\PermissionService;
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $permissions = PermissionService::getPermissions();
            return view('admin.permission.index',compact('permissions'));


    }


    public function store(PermissionRequest $request){
        try {
            $permission_obj = new PermissionService;
            $permission_response = $permission_obj->store($request);
            return $permission_response;

        } catch (\Throwable $th) {
            return $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(PermissionRequest $request, Permission $permission){
        try {
           $permission_obj = new PermissionService;
           $permission_response = $permission_obj->update($request,$permission);
           return $permission_response;
        } catch (\Throwable $th) {
           return $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        try {
             $permission_response = PermissionService::destroy($id);
             return $permission_response;
        } catch (\Throwable $th) {
            return $th;
        }

}
}
