<?php

namespace App\Models;

use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Model;

class BalanceSheet extends Model
{
    use  Multitenantable;
    
    protected $fillable = [
        'customer_id' ,
         'transaction_id' ,
         'debit',
         'credit',
         'balance',
         'remarks',
         'amount',
         'payment_date'
    ];

    function getCustomer(){
        return $this->belongsTo('App\User', 'customer_id');
    }

    function getTransaction(){
        return $this->belongsTo('App\Models\Transaction', 'transaction_id');
    }

}
