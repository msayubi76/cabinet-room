<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'setting';

    protected $fillable = [
        'privacy_and_policy_detail',
        'about_us_detail',
        'contact_us_detail',
        'name','email','mobile_no1','mobile_no2','address'
    ];
}
