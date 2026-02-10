<?php

namespace App\Enums;

enum EntityType: string
{
    case Product = 'product';
    case Category = 'category';
    case Page = 'page';

    public static function fromModel(string $model): self
    {
        return match ($model) {
            \App\Models\Product::class => self::Product,
            \App\Models\ProductCategory::class => self::Category,
            \App\Models\Page::class => self::Page,
            default => throw new \InvalidArgumentException("Unknown entity type: $model"),
        };
    }
}
