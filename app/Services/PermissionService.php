<?php

namespace App\Services;



use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PermissionRequest;

class PermissionService
{
    public static function getPermissions(){

            $permissions = Permission::orderBy('id', 'DESC')->paginate(30);
            return $permissions;

    }

    public function store(PermissionRequest $request)
    {
        DB::beginTransaction();
        $data = $request->validated();


        $permission = Permission::create($data);
        DB::commit();
        $response = ['status' => true, 'message' => 'Sub Permission added successfully.', 'Permission' => $permission];

        return $response;
    }

    public function update(PermissionRequest $request, Permission $permission){
        DB::beginTransaction();
        $data = $request->validated();

        $permission->update($data);

        DB::commit();
        $response = ['status' => true, 'message' => 'Sub user updated.', 'permission' => $permission];
        return $response;
    }

    public static function destroy($id)
    {
        DB::beginTransaction();
        $permission = Permission::findorFail($id);
        $permission->delete();
        DB::commit();
        $response = ['status' => true, 'message' => ' permission removed successfully.'];
        return $response;
    }



}
