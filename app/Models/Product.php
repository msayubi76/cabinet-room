<?php

namespace App\Models;

use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, Multitenantable;
    protected $fillable = [
        'make', 
        'feature_image',
        'sub_category_id', 
        'status', 
        'purchase_price', 
        'price',  
        'category_id', 
        'model', 
        'package', 
        'year', 
        'hybrid_petrol_diesel', 
        '_wd_4wd', 
        'seats', 
        'chassis_no', 
        'cc', 
        'color', 
        'mileage', 
        'transmission', 
        'power_window', 
        'power_stearing', 
        'ac_aac', 
        'navigation_tc_dvd', 
        'steering_audio_controls', 
        'cruise_controls', 
        'paddle_shifters', 
        'key_start_push_start', 
        'alloys', 
        'fog', 
        'rear_spoiler', 
        'door_visors', 
        'aero_kit', 
        'leather_seats', 
        'back_camera', 
        'bumper_sensors', 
        'sunroof_penoramic', 
        'retractable_side_mirrors', 
        'keyless_entry', 
        'back_tyre', 
        'abs', 
        'ab', 
        'is_active', 
        'is_reserved', 
        'country', 
        'description', 
        'currency_type', 
        'is_damage'
    ];

    function getCategory(){
        return $this->belongsTo('App\Models\Category','category_id');
    }
    function getSubCategory(){
        return $this->belongsTo('App\Models\SubCategory','sub_category_id');
    }
    
    public function getTransactionsSelline()
    {
        return $this->hasOne('App\Models\TransactionSellLine', 'product_id');
    }

    public function getMedia($id, $model_type)
    {
        return Media::where('transaction_id', $id)->where('model_type', $model_type)->get();
    }
}
