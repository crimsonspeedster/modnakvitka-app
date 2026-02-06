<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductTranslations extends Model
{
    protected $fillable = [
        'title',
        'short_description',
        'description',
        'lang_id',
        'product_id',
    ];

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }
}
