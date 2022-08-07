<?php
namespace App\Http\Controllers;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Services\PermissionService;
use App\Http\Requests\PermissionRequest;
class PermissionController extends Controller
{
public function index()
{
$permissions = PermissionService::getPermissions();
return view('admin.permission.index', compact('permissions'));
}

public function store(PermissionRequest $request)
{
try {
$permission_response = PermissionService::store($request);
return $permission_response;
} catch (\Throwable $th) {
return $th;
}
}

public function update(PermissionRequest $request, Permission $permission)
{
try {
$permission_response = PermissionService::update($request, $permission);
return $permission_response;
} catch (\Throwable $th) {
return $th;
}
}

public function destroy($id)
{
try {
$permission_response = PermissionService::destroy($id);
return $permission_response;
} catch (\Throwable $th) {
return $th;
}
}
}
