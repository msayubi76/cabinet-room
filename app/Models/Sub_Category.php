<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_Category extends Model
{
    use HasFactory;
     protected $table = 'sub_categories';
    protected $fillable = [
        'category_id',
        'name',
        'is_active',
        'image_folder',
        'image_name',
        'image_url',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class,'sub_category_id');
    }
}
