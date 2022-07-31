<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Services\RoleService;
use App\Http\Requests\RoleRequest;
use App\Services\PermissionService;
use App\Http\Requests\AssignRoleRequest;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(){
        $roles = RoleService::getRoles();
        return view('admin.role.index',compact('roles'));


    }

    public function store(RoleRequest $request){
        try {
           $role_response =RoleService::store($request);
            return $role_response;
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function update(RoleRequest $request, Role $role){
        try {
           $role_response = RoleService::update($request,$role);
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

     public function attachRole($role){
        $permissions = PermissionService::moduleWisePermissions();
        $modules = PermissionService::moduleWisePermissions();
        $roles =Role::find($role);
        // dd($permissions);
        return view('admin.role.attachpermission',compact('roles','permissions','modules'));


     }
     public function assignRole(AssignRoleRequest $request){


        try {
            $role_response =RoleService::store($request);
            dd($role_response);
             return $role_response;
         } catch (\Throwable $th) {
             return $th;
         }

     }
}
