<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable =[
        'user_id', 'payment_id', 'shipping_detail_id', 'order_status', 'tax', 'delivery_fee', 'cancel_at',
    ];
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class,'order_id');
    }
    public function payments(){
        return $this->belongsTo(Payment::class, 'payment_id');
    }
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function shipping(){
        return $this->belongsTo(ShippingDetail::class, 'shipping_detail_id');
    }
}
