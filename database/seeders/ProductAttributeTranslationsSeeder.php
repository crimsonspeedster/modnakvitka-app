<?php

namespace Database\Seeders;

use App\Models\Langs;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeTranslations;
use App\Models\ProductCategoryTranslations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductAttributeTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productAttributes = ProductAttribute::all()->pluck('id')->toArray();
        $langs = Langs::all()->pluck('id')->toArray();

        foreach ($productAttributes as $attribute_id) {
            foreach ($langs as $lang_id) {
                ProductAttributeTranslations::factory()->create([
                    'attribute_id' => $attribute_id,
                    'lang_id' => $lang_id,
                ]);
            }
        }
    }
}
