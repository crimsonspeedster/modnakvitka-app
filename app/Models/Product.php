<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    protected $casts = [
        'is_on_sale' => 'boolean',
        'price' => 'float',
        'sale_price' => 'float',
    ];

    public function slug (): MorphOne {
        return $this->morphOne(
            Slug::class,
            'entity',
            'entity_type',
            'entity_id',
        )
            ->where('lang_id', app('lang_id'));
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

    public function translation(): HasOne {
        return $this->hasOne(ProductTranslations::class)
            ->where('lang_id', app('lang_id'));
    }

    #[Scope]
    protected function scopePublished (Builder $query): Builder {
        return $query->where('status', 'published');
    }
}
