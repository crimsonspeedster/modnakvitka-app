<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AttributeTerm extends Model
{
    use HasFactory;

    protected $fillable = [

    ];

    public function productAttribute (): BelongsTo {
        return $this->belongsTo(
            ProductAttribute::class
        );
    }

    public function translation(): HasOne {
        return $this->hasOne(
            AttributeTermTranslations::class,
        )
            ->where('lang_id', app('lang_id'));
    }

    public function translations(): HasMany
    {
        return $this->hasMany(
            AttributeTermTranslations::class,
        );
    }

    public function getTitleAttribute(): string {
        return $this->translation?->title ?? '';
    }
}
