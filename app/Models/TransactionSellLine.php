<?php

namespace App\Models;

use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionSellLine extends Model
{
    use SoftDeletes, Multitenantable;
    protected $fillable = [
        'transaction_id', 
        'sale_price',
        'actual_sale_price',
        'customer_sale_price',
        'documents',
        'product_id',
        'part_id',
        'type'
    ];

    public function getProduct()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    public function getPart()
    {
        return $this->belongsTo('App\Models\JdmParts', 'part_id');
    }
    public function getDocuments()
    {
        return $this->hasMany('App\Models\Media', 'selline_id');
    }
    public function getTransaction()
    {
        return $this->belongsTo('App\Models\Transaction', 'transaction_id');
    }


//  first time all prices will be same. 
//  admin will update actual_sale_price, customer_sale_price
}
