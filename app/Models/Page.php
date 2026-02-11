<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
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

    public function slugs (): MorphMany
    {
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

    public function translation(): HasOne {
        return $this->hasOne(PageTranslations::class)
            ->where('lang_id', app('lang_id'));
    }

    public function translations(): HasMany
    {
        return $this->hasMany(PageTranslations::class);
    }

    public function getTitleAttribute (): string
    {
        return $this->translation?->title ?? '';
    }

    #[Scope]
    protected function scopePublished (Builder $query): Builder {
        return $query->where('status', 'published');
    }
}
