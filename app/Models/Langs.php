<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Langs extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'locale',
        'is_active',
        'is_default',
    ];

    protected static function booted() : void
    {
        static::saving(function ($lang) {
            if ($lang->is_default) {
                static::where('id', '!=', $lang->id)
                    ->update(['is_default' => false]);
            }
        });

        static::deleting(function ($lang) {
            if ($lang->is_default) {
                throw new \Exception('You cannot delete default language');
            }
        });
    }

    public function productTranslations(): HasMany
    {
        return $this->hasMany(ProductTranslations::class, 'lang_id', 'id');
    }

    public function productCategoryTranslations(): HasMany
    {
        return $this->hasMany(ProductCategoryTranslations::class, 'lang_id', 'id');
    }

    public function productAttributeTranslations(): HasMany
    {
        return $this->hasMany(ProductAttributeTranslations::class, 'lang_id', 'id');
    }

    public function seoTranslations(): HasMany
    {
        return $this->hasMany(SeoTranslations::class, 'lang_id', 'id');
    }

    public function attributeTermTranslations(): HasMany
    {
        return $this->hasMany(AttributeTermTranslations::class, 'lang_id', 'id');
    }
}
