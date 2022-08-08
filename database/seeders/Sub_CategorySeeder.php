<?php

namespace Database\Seeders;

use App\Models\Sub_Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Sub_CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sub_Category::factory()
        ->count(5)
        ->create();
    }
}
