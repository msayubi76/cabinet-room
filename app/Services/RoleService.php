<?php

namespace App\Services;

use App\Models\Role;

use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $response = ['status' => true, 'message' => 'Sub role added successfully.', 'role' => $role];

        return $response;
    }

    public static function update(RoleRequest $request, Role $role){
        DB::beginTransaction();
        $data = $request->validated();

        $role->update($data);


        DB::commit();
        $response = ['status' => true, 'message' => 'Sub role updated.', 'role' => $role];
        return $response;
    }

    public static function destroy($id)
    {
        DB::beginTransaction();
        $role = Role::findorFail($id);
        $role->delete();
        DB::commit();
        $response = ['status' => true, 'message' => 'Sub role removed successfully.'];
        return $response;
    }

}
