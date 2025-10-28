<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'category_id',
        'sub_category_id',
        'description',
        'actual_price',
        'discount',
        'saleprice',
        'shipping_charge',
        'colour',
        'feature_image',
        'feature_image_name',
        'folder_name',
        // 'images',
        'stock',
        'length',
        'width',
        'height',
        'is_feature_product',
        'is_arrival_product',
        'currency',
        'short_description',
        'is_active',
        'is_for_request_quote',

        'created_by',
        'updated_by',
        'deleted_by',

        'delivered_in',
        'rating',
        'sku',
        'is_installment_available',

             // TCS and shipping fields
             'weight',
             'weight_unit',
             'dimension_unit',
             'tcs_product_description',


    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }


    public function subCategories()
    {
        return $this->category->subcategories;
    }


    public function cart()
    {
        return $this->hasMany(Cart::class, 'cart_id');
    }


    public function images()
    {
        return $this->morphMany(Media::class, 'model');
    }
    public function orderDetail()
    {
        return $this->hasmany(OrderDetail::class, 'product_id');
    }

    public function variations(): HasMany
    {
        return $this->hasMany(Variation::class);
    }

     /**
     * Get product description for TCS shipment
     */
    public function getTCSDescription()
    {
        return $this->tcs_product_description ?? $this->name;
    }

    /**
     * Get product weight in kg
     */
    public function getWeightInKg()
    {
        if (!$this->weight) return 0.5; // Default weight
        
        return match($this->weight_unit) {
            'g' => $this->weight / 1000,
            'lbs' => $this->weight * 0.453592,
            default => $this->weight, // kg
        };
    }

    /**
     * Get product dimensions in cm
     */
    public function getDimensionsInCm()
    {
        $multiplier = match($this->dimension_unit) {
            'm' => 100,
            'inch' => 2.54,
            'mm' => 0.1,
            default => 1, // cm
        };

        return [
            'length' => ($this->length ?? 0) * $multiplier,
            'width' => ($this->width ?? 0) * $multiplier,
            'height' => ($this->height ?? 0) * $multiplier,
        ];
    }

    /**
     * Calculate volumetric weight for TCS
     */
    public function getVolumetricWeight()
    {
        $dims = $this->getDimensionsInCm();
        $volumetricWeight = ($dims['length'] * $dims['width'] * $dims['height']) / 5000; // TCS volumetric formula
        return max($this->getWeightInKg(), $volumetricWeight);
    }

}
