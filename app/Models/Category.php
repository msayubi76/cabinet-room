<?php

namespace App\Models;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'is_active',
        'image_folder',
        'image_name',
        'image_url',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class,'category_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }
}
