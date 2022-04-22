<?php

namespace App\Models;

use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JdmParts extends Model
{
    use SoftDeletes, Multitenantable;

    protected $fillable = [
        'product',
        'category',
        'name',
        'currency_type',
        'price',
        'feature_image',
        'part_detail', 
        'status'
    ];

    function getCategory(){
        return $this->belongsTo('App\Models\Category','category');
    }
    public function getProduct()
    {
        return $this->belongsTo('App\Models\Product', 'product');
    }
    public function getMedia($id, $model_type)
    {
        return Media::where('transaction_id', $id)->where('model_type', $model_type)->get();
    }
}
