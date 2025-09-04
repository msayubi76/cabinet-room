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

$cities = [
    [
        'name' => 'Islamabad',
        'charges' => 0,
    ],
    [
        'name' => 'Rawalpindi',
        'charges' => 0,
    ],
    [
        'name' => 'Lahore',
        'charges' => 20,
    ],
    [
        'name' => 'Multan',
        'charges' => 20,
    ],
    [
        'name' => 'Abottabad',
        'charges' => 20,
    ]
];



return [
    'curencies' =>  $currencies,
    'cities' =>  $cities,
];
