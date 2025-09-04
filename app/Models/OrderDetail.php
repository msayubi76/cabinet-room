<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price','variation_id'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
    public function variation(): BelongsTo
    {
        return $this->belongsTo(Variation::class);
    }
}
