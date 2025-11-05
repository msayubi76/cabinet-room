<?php

return [

    /*
    |--------------------------------------------------------------------------
    | TCS Base URLs
    |--------------------------------------------------------------------------
    */
    'base_url' => env('TCS_BASE_URL', 'https://devconnect.tcscourier.com'),
    'ecom_url' => env('TCS_ECOM_URL', 'https://devconnect.tcscourier.com/ecom/api'),
    'bearer_token' => env('TCS_BEARER_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | TCS Authentication Credentials (for token)
    |--------------------------------------------------------------------------
    */
    'client_id'     => env('TCS_CLIENT_ID', 'TCS_eCom_Dev'),
    'client_secret' => env('TCS_CLIENT_SECRET', 'TCS_eCom_Dev'),
    'username'      => env('TCS_USERNAME', 'TCS_eCom_Dev'),
    'password'      => env('TCS_PASSWORD', 'TCS_eCom_Dev'),
    'tcs_account'   => env('TCS_ACCOUNT', '04011K1'),

    /*
    |--------------------------------------------------------------------------
    | Shipper Details
    |--------------------------------------------------------------------------
    */
    'shipper_name'     => env('TCS_SHIPPER_NAME', env('APP_NAME', 'Test Company')),
    'shipper_address'  => env('TCS_SHIPPER_ADDRESS', '123 Test Street, Karachi'),
    'shipper_phone'    => env('TCS_SHIPPER_PHONE', '923001234567'),
    'shipper_email'    => env('TCS_SHIPPER_EMAIL', 'operations@yourcompany.com'),
    'cost_center_code' => env('TCS_COST_CENTER_CODE', 'Test-01'),
    'origin_city'      => env('TCS_ORIGIN_CITY', 'Karachi'),

    /*
    |--------------------------------------------------------------------------
    | Shipping Rate Defaults
    |--------------------------------------------------------------------------
    */
    'rates' => [
        'express' => [
            'base_rate'        => 300,  // PKR for first 0.5kg
            'additional_rate'  => 100,  // PKR per additional 0.5kg
            'min_weight'       => 0.1,
        ],
        'economy' => [
            'base_rate'        => 200,
            'additional_rate'  => 70,
            'min_weight'       => 0.1,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | COD / Additional Charges
    |--------------------------------------------------------------------------
    */
    'cod_charges_percentage' => env('TCS_COD_CHARGES_PERCENTAGE', 2), // 1–3%
];
