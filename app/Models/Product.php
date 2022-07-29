<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
      'name',
      'category_id',
      'subcategory_id',
      'description',
      'actual_price',
      'discount',
      'shipping_charge',
      'colour',
      'feature_image',
      'images',
      'length',
      'width',


  ];
  public function category(){
    return $this->belongsTo(Category::class, 'category_id','id');
}
public function subcategory(){
    return $this->belongsTo(SubCategory::class, 'subcategory_id','id');
}
}
