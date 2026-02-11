<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttributeTermTranslations extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'lang_id',
        'attribute_term_id',
    ];

    public function attributeTerm(): BelongsTo {
        return $this->belongsTo(
            AttributeTerm::class,
            'attribute_term_id',
            'id'
        );
    }

    public function lang(): BelongsTo
    {
        return $this->belongsTo(Langs::class);
    }
}
