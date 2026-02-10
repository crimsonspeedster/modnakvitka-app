<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Seo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = Page::all()->pluck('id')->toArray();
        $products = Product::all()->pluck('id')->toArray();
        $productCategories = ProductCategory::all()->pluck('id')->toArray();

        foreach ($pages as $page_id) {
            Seo::factory()->create([
                'entity_id' => $page_id,
                'entity_type' => 'App\Models\Page',
            ]);
        }

        foreach ($products as $product_id) {
            Seo::factory()->create([
                'entity_id' => $product_id,
                'entity_type' => 'App\Models\Product',
            ]);
        }

        foreach ($productCategories as $product_category_id) {
            Seo::factory()->create([
                'entity_id' => $product_category_id,
                'entity_type' => 'App\Models\ProductCategory',
            ]);
        }
    }
}
