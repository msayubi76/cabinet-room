<?php

namespace App\Models;

use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes, Multitenantable;
    protected $fillable = [
        'name' ,'image','detail'
    ];
    function Products(){
        return $this->hasMany('App\Models\Product');
    }
    function getSubcategory(){
        return $this->hasMany('App\Models\SubCategory');
    }
}
