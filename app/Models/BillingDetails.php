<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingDetails extends Model
{
    use HasFactory;

    protected $table = 'billingdetails';

    protected $fillable =[
        'first_name', 'last_name', 'address', 'city', 'country', 'post_code', 'phone_number', 'email','notes'
    ];
}
