<?php

namespace Database\Seeders;

use App\Models\Langs;
use App\Models\Page;
use App\Models\PageTranslations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $langs = Langs::all()->pluck('id')->toArray();
        $pages = Page::all()->pluck('id')->toArray();

        foreach ($pages as $page_id) {
            foreach ($langs as $lang_id) {
                PageTranslations::factory()->create([
                    'page_id' => $page_id,
                    'lang_id' => $lang_id,
                ]);
            }
        }
    }
}
