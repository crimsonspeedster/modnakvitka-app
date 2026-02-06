<?php

namespace Database\Factories;

use App\Models\Langs;
use App\Models\ProductCategory;
use App\Models\ProductCategoryTranslations;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCategoryTranslations>
 */
class ProductCategoryTranslationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
        ];
    }
}
