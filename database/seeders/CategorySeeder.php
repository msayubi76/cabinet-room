<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()
            // ->has(
            //     SubCategory::factory()->count(rand(1,12))
            //         ->state(function (array $attributes, Category $category) {
            //             return ['category_id' => $category->id];
            //         }),
            //     'subcategories'
            // )

            ->count(10)
            ->create();
    }
}
