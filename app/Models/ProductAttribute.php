<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = [

    ];

    public function products (): BelongsToMany {
        return $this->belongsToMany(
            Product::class,
            'product_attribute_products',
            'product_attribute_id',
            'product_id'
        );
    }

    public function attributeTerms (): HasMany {
        return $this->hasMany(
            AttributeTerm::class
        );
    }
}
