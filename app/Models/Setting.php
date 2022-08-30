<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'setting';

    protected $fillable = [

        'about_us_detail',
        'contact_us_detail',
        'name','email','mobile_no1','mobile_no2','address',
        'privacyAndPolicyDetail',
    ];
}
