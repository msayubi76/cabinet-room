<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\SubCategory;
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
        $actual_price = rand(6000, 500000);
        $discount = rand(0,40);

        $percent_value = ($actual_price * $discount)/100;

        $sale_price = $actual_price - $percent_value;

        return [
            'name' => $this->faker->name(),
            'category_id' =>  rand(1,10),
            'sub_category_id' =>  rand(1,10),
            'feature_image' => $this->faker->imageUrl(),

            'description' => $this->faker->paragraph(),
            'actual_price' => $actual_price,
            'discount' => $discount,
            'saleprice' => $sale_price,
            'shipping_charge' => $this->faker->numberBetween(0, 50),
            'colour' => $this->faker->colorName(),
            'length' => $this->faker->randomDigit(1,50),
            'width' => $this->faker->randomDigit(1,50),
            'is_feature_product' => rand(0,1),
            'is_arrival_product' => rand(0,1),
            'is_active' => $this->faker->boolean(),

        ];
    }
}
