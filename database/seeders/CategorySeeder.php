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
        // Category::factory()
        //     // ->has(
        //     //     SubCategory::factory()->count(rand(1,12))
        //     //         ->state(function (array $attributes, Category $category) {
        //     //             return ['category_id' => $category->id];
        //     //         }),
        //     //     'subcategories'
        //     // )

        //     ->count(10)
        //     ->create();


        $array = [
            [
                'name' => 'Smart Watches',
                'image_url' => '/images/category/smart-watch.webp',
                'is_active' => true
            ],
            [
                'name' => 'Neckbands',
                'image_url' => '/images/category/neckbands.webp',
                'is_active' => true
            ],
            [
                'name' => 'Wireless Earbuds',
                'image_url' => '/images/category/wireless-earbuds.webp',
                'is_active' => true
            ],
            [
                'name' => 'Handsfree',
                'image_url' => '/images/category/handsfree.webp',
                'is_active' => true
            ],
            [
                'name' => 'PowerBanks',
                'image_url' => '/images/category/power-banks.webp',
                'is_active' => true
            ],
            [
                'name' => 'Charger',
                'image_url' => '/images/category/smart-watch.webp',
                'is_active' => true
            ],
            [
                'name' => 'Headphones',
                'image_url' => '/images/category/headphones.webp',
                'is_active' => true
            ],
            [
                'name' => 'Car Chargers',
                'image_url' => '/images/category/car-chargers.webp',
                'is_active' => true
            ],
            [
                'name' => 'Speakers',
                'image_url' => '/images/category/speakers.webp',
                'is_active' => true
            ],
        ];

        Category::insert($array);
    }
}
