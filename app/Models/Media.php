<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $tabl = 'media';

    protected $fillable = [
        'name',
        'size',
        'folder_name',
        'url',
        'extension',
        'model_type',
        'model_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];


    public function model()
    {
        return $this->morphTo();
    }




}
