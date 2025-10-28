<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'stock',
        'product_id',
        'value',
        'discount',
        'sale_price',
        // TCS fields
        'weight',
        'length',
        'width',
        'height',
        'tcs_description',
        'sku'
    ];

    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get weight in kg
     */
    public function getWeightInKg()
    {
        if (!$this->weight) {
            return $this->product->getWeightInKg();
        }
        return $this->weight;
    }

    /**
     * Get TCS description
     */
    public function getTCSDescription()
    {
        return $this->tcs_description ?? $this->product->getTCSDescription();
    }

    /**
     * Get dimensions in cm
     */
    public function getDimensionsInCm()
    {
        if ($this->length && $this->width && $this->height) {
            return [
                'length' => $this->length,
                'width' => $this->width,
                'height' => $this->height,
            ];
        }
        
        return $this->product->getDimensionsInCm();
    }
}
