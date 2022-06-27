<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Services\RoleService;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
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
    public function destroy($id){
        try {
             $role_response = RoleService::destroy($id);
             return $role_response;
        } catch (\Throwable $th) {
            return $th;
        }
     }
}
