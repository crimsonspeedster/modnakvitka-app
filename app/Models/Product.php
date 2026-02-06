<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'price',
        'sale_price',
        'is_on_sale',
        'sku',
        'published_at',
    ];

    public function slug (): MorphOne {
        return $this->morphOne(
            Slug::class,
            'entity',
            'entity_type',
            'entity_id',
        );
    }

    public function categories (): BelongsToMany {
        return $this->belongsToMany(
            ProductCategory::class,
            'product_category_products',
            'product_id',
            'product_category_id'
        );
    }

    public function attributes (): BelongsToMany {
        return $this->belongsToMany(
            ProductAttribute::class,
            'product_attribute_products',
            'product_id',
            'product_attribute_id',
        );
    }
}
