<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [

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

    public function slugs (): MorphMany {
        return $this->morphMany(
            Slug::class,
            'entity',
            'entity_type',
            'entity_id',
        );
    }

    public function seo (): MorphOne
    {
        return $this->morphOne(
            Seo::class,
            'entity',
            'entity_type',
            'entity_id',
        );
    }

    public function products (): BelongsToMany {
        return $this->belongsToMany(
            Product::class,
            'product_category_products',
            'product_category_id',
            'product_id'
        );
    }

    public function translation (): HasOne {
        return $this->hasOne(
            ProductCategoryTranslations::class,
        )
            ->where('lang_id', app('lang_id'));
    }

    public function translations (): HasMany {
        return $this->hasMany(
            ProductCategoryTranslations::class
        );
    }
}
