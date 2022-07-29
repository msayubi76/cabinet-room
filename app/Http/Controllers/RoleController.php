<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Services\RoleService;
use App\Http\Requests\RoleRequest;


use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(){
        $roles = RoleService::getRoles();
        return view('admin.role.index',compact('roles'));


    }

    public function store(RoleRequest $request){
        try {
            $role_obj = new RoleService;
            $role_response = $role_obj->store($request);
            return $role_response;

        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function update(RoleRequest $request, Role $role){
        try {
           $role_obj = new RoleService;
           $role_response = $role_obj->update($request,$role);
           return $role_response;
        } catch (\Throwable $th) {
           return $th;
        }
    }
    public function destroy($id){
        try {
             $role_response = RoleService::destroy($id);
             return $role_response;
        } catch (\Throwable $th) {
            return $th;
        }
     }

     public function attach($role){
        $roles =Role::find($role);
        $permission = Permission::all();
        return view('admin.role.attachpermission',compact('roles','permission'));


     }
     public function permissionassign(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permission'));

        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');


     }
}
