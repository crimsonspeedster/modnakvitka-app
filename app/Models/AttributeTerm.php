<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AttributeTerm extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_attribute_id',
    ];

    protected $hidden = [
        'product_attribute_id'
    ];

    public function productAttribute (): BelongsTo {
        return $this->belongsTo(
            ProductAttribute::class
        );
    }
}
