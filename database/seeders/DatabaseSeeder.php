<?php

namespace Database\Seeders;

use AddPermission;
use AddRoles;
use DefaultUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(DefaultUser::class);
        $this->call(AddRoles::class);
        $this->call(AddPermission::class);
    }
}
