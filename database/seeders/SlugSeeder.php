<?php

namespace Database\Seeders;

use App\Models\Langs;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Slug;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $langs = Langs::all()->pluck('id')->toArray();
        $pages = Page::all()->pluck('id')->toArray();
        $products = Product::all()->pluck('id')->toArray();
        $productCategories = ProductCategory::all()->pluck('id')->toArray();

        foreach ($langs as $lang_id) {
            foreach ($pages as $page_id) {
                Slug::factory()->create([
                    'lang_id' => $lang_id,
                    'entity_id' => $page_id,
                    'entity_type' => 'App\Models\Page',
                    'slug' => 'page--'.$page_id.'--lang--'.$lang_id,
                ]);
            }

            foreach ($products as $product_id) {
                Slug::factory()->create([
                    'lang_id' => $lang_id,
                    'entity_id' => $product_id,
                    'entity_type' => 'App\Models\Product',
                    'slug' => 'product--'.$product_id.'--lang--'.$lang_id,
                ]);
            }

            foreach ($productCategories as $product_category_id) {
                Slug::factory()->create([
                    'lang_id' => $lang_id,
                    'entity_id' => $product_category_id,
                    'entity_type' => 'App\Models\ProductCategory',
                    'slug' => 'product_category--'.$product_category_id.'--lang--'.$lang_id,
                ]);
            }
        }
    }
}
