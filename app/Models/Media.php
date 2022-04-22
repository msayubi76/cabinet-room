<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'model_type',
        'transaction_id',
        'file',
        'file_type',
    ];
}
