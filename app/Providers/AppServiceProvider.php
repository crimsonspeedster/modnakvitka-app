<?php

namespace App\Providers;

use App\Models\Langs;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Langs::firstOrCreate(
            ['code' => 'ua'],
            [
                'name' => 'Украинский',
                'locale' => 'uk',
                'code' => 'ua',
                'is_active' => true,
                'is_default' => true,
            ],
        );

        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));

        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }
}
