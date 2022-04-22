<?php

namespace App\Models;

use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use SoftDeletes, Multitenantable;
    protected $fillable = [
        'first_name', 
        'last_name', 
        'country',
        'city',
        'phone_no', 
        'product_id' ,
        'transaction_id' 
    ];


}
