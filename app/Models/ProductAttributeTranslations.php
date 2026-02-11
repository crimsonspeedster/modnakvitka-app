<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductAttributeTranslations extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'attribute_id',
        'lang_id',
    ];

    public function productAttribute (): BelongsTo {
        return $this->belongsTo(
            ProductAttribute::class,
            'attribute_id',
            'id'
        );
    }

    public function lang(): BelongsTo
    {
        return $this->belongsTo(Langs::class, 'lang_id', 'id');
    }
}
