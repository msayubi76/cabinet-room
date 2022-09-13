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
        'saleprice',
        'shipping_charge',
        'colour',
        'feature_image',
        'feature_image_name',
        'folder_name',
        // 'images',

        'length',
        'width',
        'is_feature_product',
        'is_arrival_product',
        'currency',
        'short_description',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',


    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id','id');
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id','id');
    }


    public function subCategories()
    {
        return $this->category()->subcategories;
    }


    public function cart()
    {
        return $this->hasMany(Cart::class, 'cart_id');
    }


    public function images()
    {
        return $this->morphMany(Media::class, 'model');
    }
    public function orderDetail()
    {
        return $this->hasmany(OrderDetail::class, 'product_id');
    }




}
