<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Sub_Category;
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
            ->has(
                Sub_Category::factory()->count(5)
                    ->state(function (array $attributes, Category $category) {
                        return ['category_id' => $category->id];
                    }),
                'subcategories'
            )

            ->count(5)
            ->create();
    }
}
