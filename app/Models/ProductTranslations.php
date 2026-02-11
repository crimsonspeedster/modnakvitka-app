<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductTranslations extends Model
{
    use HasFactory;

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

    public function lang(): BelongsTo
    {
        return $this->belongsTo(Langs::class);
    }
}
