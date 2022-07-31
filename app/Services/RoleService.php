<?php

namespace App\Services;

use App\Models\Role;

use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AssignRoleRequest;

class RoleService
{
    public static function getRoles(){

            $roles = Role::orderBy('id', 'DESC')->paginate(30);
            return $roles;

    }

    public  static function store(RoleRequest $request)
    {
        DB::beginTransaction();
        $data = $request->validated();


        $role = Role::create($data);
        DB::commit();
        $response = ['status' => true, 'message' => 'Role added successfully.', 'role' => $role];

        return $response;
    }

    public static function update(RoleRequest $request, Role $role){
        DB::beginTransaction();
        $data = $request->validated();

        $role->update($data);


        DB::commit();
        $response = ['status' => true, 'message' => ' Role updated successfully.', 'role' => $role];
        return $response;
    }

    public static function destroy($id)
    {
        DB::beginTransaction();
        $role = Role::findorFail($id);
        $role->delete();
        DB::commit();
        $response = ['status' => true, 'message' => 'Role removed successfully.'];
        return $response;
    }
    public static function assignRole(AssignRoleRequest $request)
    {
        dd($request);
        DB::beginTransaction();
        $data = $request->validated();
        //
        $roleAssign = Role::create($data);

        $roleAssign->syncPermissions($request->get('permission'));
        DB::commit();
        $response = ['status' => true, 'message' => ' role added successfully.', 'roleAssign' => $roleAssign];

        return $response;
    }

}
