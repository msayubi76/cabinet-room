<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Http\Request;
use App\Services\RoleService;

class RoleController extends Controller
{
    public function index(){
        $roles = RoleService::getRoles();
        return view('index',compact('roles'));
    }
}
