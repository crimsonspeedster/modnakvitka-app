<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'status',
        'total',
        'email',
        'delivery_type',
        'city',
        'customer_name',
        'customer_phone',
        'recipient_name',
        'recipient_phone',
        'delivery_date',
        'delivery_time',
        'is_recipient_address_knowing',
        'text_in_postcard',
        'coupon_id',
    ];

    public function orderItems(): HasMany {
        return $this->hasMany(
            OrderItem::class,
        );
    }
}
