<?php

namespace Database\Seeders;

use App\Models\AttributeTerm;
use App\Models\ProductAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeTermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productAttributes = ProductAttribute::inRandomOrder()->take(5)->get();

        foreach ($productAttributes as $productAttribute) {
            AttributeTerm::factory()->create([
                'product_attribute_id' => $productAttribute->id,
            ]);
        }
    }
}
