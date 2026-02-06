<?php

namespace Database\Seeders;

use App\Models\Langs;
use App\Models\Seo;
use App\Models\SeoTranslations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeoTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seos = Seo::all()->pluck('id')->toArray();
        $langs = Langs::all()->pluck('id')->toArray();

        foreach ($langs as $lang_id) {
            foreach ($seos as $seo_id) {
                SeoTranslations::factory()->create([
                   'lang_id' => $lang_id,
                   'seo_id' => $seo_id,
                ]);
            }
        }
    }
}
