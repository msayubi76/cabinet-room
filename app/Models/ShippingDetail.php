<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingDetail extends Model
{
    use HasFactory;
    protected $table = 'shipping_details';

    protected $fillable =[
        'first_name', 'last_name', 'address', 'city', 'country', 'post_code', 'phone_number', 'email','notes', 'user_id'
    ];
    public function shipping()
    {
        return $this->hasMany(ShippingDetail::class,'shipping_detail_id');
    }
}
