<?php

namespace App\Services;
 
use App\Models\ShippingDetail;
use Illuminate\Http\Request;

class ShippingService
{


    public static function store($request)
    {

        $data = $request->only(
            [
                'first_name', 'last_name', 'address', 'city', 'country', 'post_code', 'phone_number', 'email', 'notes'
            ]
        );

        $data['user_id'] = auth()->user()->id;

       return ShippingDetail::create($data);
 
    }
}
