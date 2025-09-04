<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Services\RoleService;
use App\Http\Requests\RoleRequest;
use App\Services\PermissionService;
use App\Http\Requests\AttachPermissionRequest;

class RoleController extends Controller
{
    public function index()
    {
        $roles = RoleService::getRoles();
        return view('admin.role.index', compact('roles'));
    }

    public function store(RoleRequest $request)
    {
        try {
            $role_response = RoleService::store($request);
            return $role_response;
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function update(RoleRequest $request, Role $role)
    {
        try {
            $role_response = RoleService::update($request, $role);
            return $role_response;
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function destroy($id)
    {
        try {
            $role_response = RoleService::destroy($id);
            return $role_response;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function attachPermission($role)
    {
       try{
        $role = Role::find($role);
         $permissions = PermissionService::moduleWisePermissions();
        $modules = PermissionService::moduleWisePermissions();


        return view('admin.role.attachpermission', compact('role', 'permissions', 'modules'));
       }catch (\Throwable $th) {
          return $th;
    }
    }
    public function storeAttachPermissions(AttachPermissionRequest $request)
    {
        try {
            $role_response = RoleService::storeAttachPermissions($request);
            return redirect(route('roles.index'))->with('success', 'Permission attached succesfully');
        } catch (\Throwable $th) {
            return redirect(route('roles.index'))->with('error', $th->getMessage());
        }
    }


}
