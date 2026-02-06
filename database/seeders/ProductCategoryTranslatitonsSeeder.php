<?php

namespace Database\Seeders;

use App\Models\Langs;
use App\Models\ProductCategory;
use App\Models\ProductCategoryTranslations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategoryTranslatitonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ProductCategory::all()->pluck('id')->toArray();
        $langs = Langs::all()->pluck('id')->toArray();

        foreach ($categories as $category_id) {
            foreach ($langs as $lang_id) {
                ProductCategoryTranslations::factory()->create([
                    'product_category_id' => $category_id,
                    'lang_id' => $lang_id,
                ]);
            }
        }
    }
}
