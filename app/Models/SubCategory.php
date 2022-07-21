<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';

    protected $fillable = [
        'category_id',
        'name',
        'is_active',
        'image_folder',
        'image_name',
        'image_url',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id','id');
    }
}
