<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttributeTermTranslations extends Model
{
    protected $fillable = [
        'title',
        'lang_id',
        'attribute_term_id',
    ];

    public function attributeTerm(): BelongsTo {
        return $this->belongsTo(AttributeTerm::class);
    }
}
