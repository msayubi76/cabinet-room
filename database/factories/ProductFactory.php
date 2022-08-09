<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Sub_Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'category_id' =>  Category::factory(),
            'sub_category_id' =>  Sub_Category::factory(),
            'feature_image' => $this->faker->imageUrl(),
            'description' => $this->faker->paragraph(),
            'actual_price' => $this->faker->randomDigit(),
            'discount' => $this->faker->randomDigit(),
            'shipping_charge' => $this->faker->randomDigit(),
            'colour' => $this->faker->colorName(),
            'length' => $this->faker->randomDigit(1,50),
            'width' => $this->faker->randomDigit(1,50),
            'is_feature_product' => rand(0,1),
            'is_arrival_product' => rand(0,1),
        ];
    }
}
