<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductCategory;
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
    public function definition(): array
    {
        $status = $this->faker->randomElement(['draft', 'published']);
        $published_at = $status === 'published' ? now() : null;
        $sale_price = $this->faker->numberBetween($min = 0, $max = 3000);

        return [
            'sku' => $this->faker->word(),
            'price' => $this->faker->numberBetween($min = 100, $max = 5000),
            'sale_price' => $sale_price,
            'is_on_sale' => $sale_price > 0,
            'status' => $status,
            'published_at' => $published_at,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Product $product) {
            $categories = ProductCategory::inRandomOrder()
                ->limit(rand(1, 3))
                ->pluck('id');

            $attributes = ProductAttribute::inRandomOrder()
                ->limit(rand(1, 3))
                ->pluck('id');

            $product->categories()->attach($categories);
            $product->attributes()->attach($attributes);
        });
    }
}
