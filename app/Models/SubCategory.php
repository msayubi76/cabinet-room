<?php

namespace App\Models;

use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes, Multitenantable;
    protected $fillable = [
        'name', 
        'category_id', 
        'detail',
        'image'
    ];

    function getCategory(){
        return $this->belongsTo('App\Models\Category','category_id');
    }

}
