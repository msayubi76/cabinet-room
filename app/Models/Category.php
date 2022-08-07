<?php

namespace App\Models;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'is_active',
        'image_folder',
        'image_name',
        'image_url',
    ];

    public function subcategories()
    {
        return $this->hasMany(Sub_Category::class,'category_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }
}
