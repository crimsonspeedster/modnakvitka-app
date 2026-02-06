<?php

namespace Database\Seeders;

use App\Models\Langs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LangsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Langs::factory()->create([
            'name' => 'Українська',
            'code' => 'ua',
            'locale' => 'uk'
        ]);

        Langs::factory()->create([
            'name' => 'Русский',
            'code' => 'ru',
            'locale' => 'ru-RU'
        ]);

        Langs::factory()->create([
            'name' => 'English',
            'code' => 'en',
            'locale' => 'en-US'
        ]);
    }
}
