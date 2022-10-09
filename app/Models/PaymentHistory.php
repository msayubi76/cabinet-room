<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;

    protected $table = 'payment_histories';

    protected $fillable =[
        'user_id', 'order_id', 'amount', 'comment','created_by','updated_by','deleted_by',
    ];
      public function order()
     {
      return $this->belongsTo(Order::class,'order_id');
     }
     public function user(){
        return $this->belongsTo(User::class,'user_id');
     }
}
