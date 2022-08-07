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

public static function store(PermissionRequest $request)
{
DB::beginTransaction();
$data = $request->validated();
$permission = Permission::create($data);
DB::commit();
$response = ['status' => true, 'message' => 'Permission added successfully.', 'permission' => $permission];
return $response;
}
public static function update(PermissionRequest $request, Permission $permission){
DB::beginTransaction();
$data = $request->validated();
$permission->update($data);
DB::commit();
$response = ['status' => true, 'message' => 'Permission updated successfully.', 'permission' => $permission];
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

public static function moduleWisePermissions()
{
return Permission::all()->groupBy('module_name');
}
}
