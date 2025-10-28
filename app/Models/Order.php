<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'payment_id', 'shipping_detail_id', 'order_status', 'tax', 'delivery_fee', 'cancel_at','order_receipt',
             // Add TCS fields
             'tcs_tracking_number', 'tcs_consignment_number', 'tcs_receipt_url',
             'tcs_shipment_data', 'tcs_label_url', 'tcs_status'
    ];
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function shipping()
    {
        return $this->belongsTo(ShippingDetail::class, 'shipping_detail_id');
    }
    public function paymenthistories(){
        return $this->hasMany(paymenthistories::class,'order_id');
    }
    /**
     * Check if TCS shipment is created
     */
    public function hasTCSShipment()
    {
        return !empty($this->tcs_tracking_number);
    }

    /**
     * Get TCS tracking URL
     */
    public function getTCSTrackingUrl()
    {
        if ($this->tcs_tracking_number) {
            return 'https://devconnect.tcscourier.com/tracking/index.html?cn=' . $this->tcs_tracking_number;
        }
        return null;
    }
}
