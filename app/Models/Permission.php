<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

      protected $fillable = [
        'name',
        'display_name',
        'module_name',
        'guard_name',

    ];
    public function roles(){
        return $this->belongsTomany(Role::class,'role_has_permissions');
    }
}
