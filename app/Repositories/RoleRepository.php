<?php

namespace App\Repositories;

//use App\Role;
use \Spatie\Permission\Models\Role;

use App\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RoleRepository
{
    public function getRoles()
    {
        try {
            return Role::all();
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function createRole($request)
    {
        try {
            DB::beginTransaction();
            $role_request['name'] = $request->name;
            $role = Role::create($role_request);
            DB::commit();
            if( !empty($request->permission) ):
                return $this->managePermission($request->permission, $role);
             endif;
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
    public function managePermission( $request,  $role ){
        try {
            $role->syncPermissions($request);
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
    public function getRoleById($id)
    {
        try {
            return Role::find($id);
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function updateRole($request, $id)
    {
        try {
            DB::beginTransaction();
            $role = Role::find($id); 
            $role->update($request->only(['name']));
            $this->managePermission($request->permission, $role); 
            DB::commit(); 
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
    public function deleteRole($id)
    {
        try {
            DB::beginTransaction();
            Role::where('id', $id)->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
    public function getAllPermission()
    {
        try {
            $permissions = collect(DB::table('permissions')->select('*')
                        ->get())->groupBy('module_name');
            return $permissions;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
}
