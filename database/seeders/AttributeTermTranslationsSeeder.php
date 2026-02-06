<?php

namespace Database\Seeders;

use App\Models\AttributeTerm;
use App\Models\AttributeTermTranslations;
use App\Models\Langs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeTermTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $langs = Langs::all()->pluck('id')->toArray();
        $attributeTerms = AttributeTerm::all()->pluck('id')->toArray();

        foreach ($langs as $langId) {
            foreach ($attributeTerms as $attributeTermId) {
                AttributeTermTranslations::factory()->create([
                    'lang_id' => $langId,
                    'attribute_term_id' => $attributeTermId,
                ]);
            }
        }
    }
}
