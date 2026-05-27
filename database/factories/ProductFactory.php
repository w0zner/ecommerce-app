<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku' => fake()->unique()->numberBetween(100000, 999999),
            'name' => fake()->word(),
            'description' => fake()->text(200),
            'image_path' => 'products/' . fake()->image('public/storage/products', 640, 480, null, false),
            'price' => fake()->randomFloat(0, 50000, 10000000),
            'subcategory_id' => fake()->numberBetween(1,632),
        ];
    }
}
