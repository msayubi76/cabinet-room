<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasPermissions;


class Role extends Model
{
    use HasFactory,HasPermissions;


    protected $table = 'roles';

    protected $fillable = [
        'name',
        'guard_name',

    ];
    public function permissions(){
        return $this->belongsTomany(Permission::class,'role_has_permissions');
    }
}
