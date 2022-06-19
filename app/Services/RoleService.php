<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleService
{
    public static function getRoles(){
        try {
            //code...
        } catch (\Throwable $th) {
            return $th;
        }       
    }
}