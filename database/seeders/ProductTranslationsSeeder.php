<?php

namespace Database\Seeders;

use App\Models\Langs;
use App\Models\Product;
use App\Models\ProductTranslations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $langs = Langs::all()->pluck('id')->toArray();
        $products = Product::all()->pluck('id')->toArray();

        foreach ($products as $product_id) {
            foreach ($langs as $lang_id) {
                ProductTranslations::factory()->create([
                    'lang_id' => $lang_id,
                    'product_id' => $product_id,
                ]);
            }
        }
    }
}
