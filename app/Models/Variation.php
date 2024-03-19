<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'stock', 'product_id', 'value'];

    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }
}
