<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductPreviewResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        return ProductPreviewResource::collection(
            Product::published()
            ->with([
                'translation:id,product_id,title',
                'slug',
                'categories.translation:id,product_category_id,title',
                'categories.slug',
            ])
            ->paginate(5)
        );
    }

    public function single (string $product_id) {
        return $product_id;
    }
}
