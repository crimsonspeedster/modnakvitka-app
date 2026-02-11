<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

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

    protected static function booted() : void{
        static::saving(function ($product) {
            if ($product->status === 'published' && !$product->published_at) {
                $product->published_at = now();
            } elseif ($product->status === 'draft') {
                $product->published_at = null;
            }
        });

        static::created(function ($product) {
            $langs = Langs::all();

            foreach ($langs as $lang) {
                $product->slugs()->create([
                    'lang_id' => $lang->id,
                    'slug' => Str::slug($product->translation?->title ?? 'product--'.$product->id.'--lang--'.$lang->id),
                ]);
            }

            $product->seo()->create();
        });

        static::deleting(function ($product) {
            $product->seo()->delete();
            $product->slugs()->delete();
        });
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

    public function slug (): MorphOne {
        return $this->morphOne(
            Slug::class,
            'entity',
            'entity_type',
            'entity_id',
        )
            ->where('lang_id', app('lang_id'));
    }

    public function slugs (): MorphMany
    {
        return $this->morphMany(
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

    public function translation(): HasOne {
        return $this->hasOne(ProductTranslations::class)
            ->where('lang_id', app('lang_id'));
    }

    public function translations(): HasMany
    {
        return $this->hasMany(ProductTranslations::class);
    }

    public function getTitleAttribute(): string {
        return $this->translation?->title ?? '';
    }

    #[Scope]
    protected function scopePublished (Builder $query): Builder {
        return $query->where('status', 'published');
    }
}
