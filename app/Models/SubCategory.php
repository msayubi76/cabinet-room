<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
     protected $table = 'sub_categories';
    protected $fillable = [
        'category_id',
        'name',
        'is_active',
        'image_folder',
        'image_name',
        'image_url',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id','id');
    }
    public function products()
    {
        return $this->hasMany(Product::class,'sub_category_id','id');
    }
}
