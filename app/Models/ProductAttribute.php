<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = [

    ];

    public function products (): BelongsToMany {
        return $this->belongsToMany(
            Product::class,
            'product_attribute_products',
            'product_attribute_id',
            'product_id'
        );
    }

    public function attributeTerms (): HasMany {
        return $this->hasMany(
            AttributeTerm::class
        );
    }

    public function translation(): HasOne {
        return $this->hasOne(
            ProductAttributeTranslations::class,
            'attribute_id',
            'id'
        )
            ->where('lang_id', app('lang_id'));
    }

    public function translations(): HasMany
    {
        return $this->hasMany(
            ProductAttributeTranslations::class,
            'attribute_id',
            'id'
        );
    }

    public function getTitleAttribute(): string {
        return $this->translation?->title ?? '';
    }
}
