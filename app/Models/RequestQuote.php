<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestQuote extends Model
{
    use HasFactory;
    protected $table = 'request_quotes';

    protected $fillable = [

        'user_id','email','name','phone','address',
        'discription',
    ];
}
