<?php

namespace App\Models;

use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes, Multitenantable;
    protected $fillable = [
        'customer_id',
        'transaction_no',
        'customer_name',
        'transaction_date',
        'paid_amount',

        'total',
        'sub_total',
        'customer_total_amount',
        'shipping_detail',
        'type',
        'documents',

        'payment_status',  //paid, partial, none
        'order_status', //pending, accept, reject, in_process, complete
    ];


    public function getTransactionsSelline()
    {
        return $this->hasOne('App\Models\TransactionSellLine', 'transaction_id');
    }
    public function getCustomer()
    {
        return $this->belongsTo('App\User', 'customer_id');
    }

    
    public function getMedia()
    {
        return $this->hasMany('App\Models\Media', 'transaction_id');
    }
    public function getPayments()
    {
        return $this->hasMany('App\Models\BalanceSheet', 'transaction_id');
    }


}
