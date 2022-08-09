<?php

// use Illuminate\Support\Facades\Facade;
$currencies = [
    (object) [
        'name' => 'Dollar',
        'code' => '$',
        'pkr_value' => '150', //1 dollar equal to this pkr value
    ],
    (object) [
        'name' => 'Rupees',
        'code' => 'Rs',
        'pkr_value' => '1',
    ],
];



return [
    'curencies' =>  collect($currencies),
];
