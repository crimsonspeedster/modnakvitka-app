<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            LangsSeeder::class,
            ProductCategorySeeder::class,
            ProductCategoryTranslatitonsSeeder::class,
            ProductAttributeSeeder::class,
            ProductAttributeTranslationsSeeder::class,
            AttributeTermSeeder::class,
            AttributeTermTranslationsSeeder::class,
            ProductSeeder::class,
            ProductTranslationsSeeder::class,
            PageSeeder::class,
            PageTranslationsSeeder::class,
            InstagramPostSeeder::class,
            SlugSeeder::class,
            OrderSeeder::class,
            CouponSeeder::class,
            SeoSeeder::class,
            SeoTranslationsSeeder::class,
        ]);
    }
}
