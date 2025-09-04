<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable =[
        'user_id', 'status', 'method', 'payment','remaining_amount','complete_at','shipping_charges', 'total_amount'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class,'payment_id');
    }

}

