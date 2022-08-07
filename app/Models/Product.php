<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'category_id',
        'sub_category_id',
        'description',
        'actual_price',
        'discount',
        'shipping_charge',
        'colour',
        'feature_image',

        'length',
        'width',
        'is_feature_product',
        'is_arrival_product',
        'currency',
        'created_by',
        'updated_by',
        'deleted_by',


    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subcategory()
    {
        return $this->belongsTo(Sub_Category::class, 'sub_category_id');
    }
    public function cart()
    {
        return $this->hasMany(Cart::class, 'cart_id');
    }
}
