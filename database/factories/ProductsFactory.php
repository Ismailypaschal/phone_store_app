<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Brand;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' =>fake()->word(),
            'brand_id' => Brand::factory(),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 10, 1000),
            'discount_price' => fake()->optional()->randomFloat(2, 5, 900),
            'quantity' => fake()->numberBetween(0, 100),
            'img_path' => fake()->optional()->imageUrl(640, 480, true),
            'color' => fake()->safeColorName(),
            'storage' => fake()->randomElement(['64', '128', '256', '512', '1']),
            'availability_status' => fake()->randomElement(['In stock', 'Out of stock']),
            'category' => fake()->randomElement(['iphone', 'Android', "Windows"]),
            'stock_status' => fake()->boolean(80), // 80% chance of being true
        ];
    }
}
