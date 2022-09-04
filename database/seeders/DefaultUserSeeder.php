<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'fist_name' => 'admin',
                'last_name' => 'admin',
                'mobile_no' => '03015913636',
                'city' => 'islamabad',
                'address' => 'islamabad',
                'region' => 'islam',
                'type' => 'super-admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make(12345678)
            ],
            [
                'fist_name' => 'customer',
                'last_name' => 'customer',
                'mobile_no' => '03015913636',
                'city' => 'islamabad',
                'address' => 'islamabad',
                'region' => 'islam',
                'type' => 'customer',
                'email' => 'customer@gmail.com',
                'password' => Hash::make(12345678)
            ],
        ];
        User::insert($data);
    }
}
