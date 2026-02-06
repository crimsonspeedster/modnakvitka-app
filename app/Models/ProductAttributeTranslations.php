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
        return $this->belongsTo(ProductAttribute::class);
    }
}
