<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class DefaultUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'username' => 'admin123',
            'phone' => '+923027226074',
            'address' => 'Global Gate way services',
            'email' => 'info@gmail.com',
            'is_active' => true,
            'password' => bcrypt('admin'),
        ]);
    }
}
