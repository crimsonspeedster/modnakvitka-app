<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Seo extends Model
{
    use HasFactory;

    protected $table = 'seo';

    protected $fillable = [
        'entity_type',
        'entity_id',
    ];

    public function entity (): MorphTo {
        return $this->morphTo(null, 'entity_type', 'entity_id');
    }

    public function translations (): HasMany
    {
        return $this->hasMany(SeoTranslations::class, 'seo_id');
    }
}
