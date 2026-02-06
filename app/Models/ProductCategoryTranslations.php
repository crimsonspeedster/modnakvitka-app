<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductCategoryTranslations extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'product_category_id',
        'lang_id',
    ];

    protected $hidden = [
        'product_category_id',
        'lang_id',
    ];

    public function productCategory(): BelongsTo {
        return $this->belongsTo(ProductCategory::class);
    }
}
