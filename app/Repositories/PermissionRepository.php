<?php

namespace App\Repositories;
 
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;
use App\User;
use Illuminate\Support\Facades\DB;

class PermissionRepository
{
    public function getPermissions()
    {
        try {
            return Permission::all();
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function createPermission( $request )
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            Permission::create($data);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
    public function getPermissionById($id)
    {
        try {
            $permission = Permission::find($id);
            return $permission;
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function updatePermission($request, $id)
    {
        try {
            DB::beginTransaction();
            Permission::where('id', $id)->update($request->only(['name']));
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
    public function deletePermission($id)
    {
        try {
            DB::beginTransaction();
            Permission::where('id', $id)->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
    public function roles()
    {
        try {
            return Role::all();
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function getUser($id)
    {
        try {
            return User::find($id);
        } catch (\Exception $e) {
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
    
    public function saveAssignPermission($request,$user_id)
    {
        try {
            DB::beginTransaction();
             $user = User::find($user_id);
             if($user){
                 $user->syncRoles($request->roles);
                 $user->syncPermissions($request->permission);
             }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    } 
}
