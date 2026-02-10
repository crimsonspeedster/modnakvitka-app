<?php

use App\Http\Controllers\ResolveSlugController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('set-api-language')->group(function () {
    // Resolve Slug
    Route::get('/resolve-slug/{slug}', [ResolveSlugController::class, 'index']);

    // Products
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{product_id}', [ProductController::class, 'single']);

    // Product Categories
    // product-categories
    // product-categories/id

    // Pages
    // pages
    // pages/id

    // Page Settings
    // settings

    // Orders
    // POST orders

    // Contact us
    // POST contact form
    // POST букет с флористом
});
