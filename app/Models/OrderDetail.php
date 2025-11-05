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
        'order_id', 'product_id', 'quantity', 'price','variation_id',
         // TCS fields
         'item_weight',
         'item_length',
         'item_width', 
         'item_height',
         'tcs_item_description',
         'declared_value',
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

     /**
     * Get item description for TCS
     */
    public function getTCSItemDescription()
    {
        return $this->tcs_item_description ?? $this->products->name;
    }

    /**
     * Get item weight for TCS (uses product weight if not set)
     */
    public function getItemWeight()
    {
        if ($this->item_weight) {
            return $this->item_weight;
        }
        
        return $this->products->getWeightInKg() * $this->quantity;
    }

    /**
     * Get declared value for TCS
     */
    public function getDeclaredValue()
    {
        return $this->declared_value ?? ($this->price * $this->quantity);
    }
}