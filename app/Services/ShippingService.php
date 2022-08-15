<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\ShippingDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ShppingRequest;

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
