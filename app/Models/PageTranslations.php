<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageTranslations extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'page_id',
        'lang_id',
    ];

    public function page(): BelongsTo {
        return $this->belongsTo(Page::class);
    }
}
