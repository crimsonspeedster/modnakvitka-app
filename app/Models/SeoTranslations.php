<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeoTranslations extends Model
{
    use HasFactory;

    protected $fillable = [
        'seo_id',
        'lang_id',
        'title',
        'description',
        'keywords',
    ];

    public function seo(): BelongsTo {
        return $this->belongsTo(SEO::class);
    }

    public function lang(): BelongsTo
    {
        return $this->belongsTo(Langs::class);
    }
}
