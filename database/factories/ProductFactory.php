<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
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
        $product_name = fake()->unique()->words($nb = 4, $asText = true);
        $slug = Str::slug($product_name);
        return [
           'name' => $product_name,
           'slug' => $slug,
           'excerpt' => fake()->text(200),
           'description' => fake()->text(500),
           'regular_price' => fake()->numberBetween(10,500),
           'SKU' => 'DIGI'.fake()->unique()->numberBetween(100,500),
           'stock_status' => 'instock',
        //    'quantity' => fake()->numberBetween(100,250),
           'image' => 'digital_'.fake()->numberBetween(1,12).".jpg",
           'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
