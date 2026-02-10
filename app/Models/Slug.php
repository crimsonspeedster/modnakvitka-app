<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;

class Slug extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'entity_id',
        'entity_type',
        'lang_id',
    ];

    public function entity (): MorphTo {
        return $this->morphTo(null, 'entity_type', 'entity_id');
    }

    public function translations () : Collection {
        return self::where('entity_type', $this->entity_type)
            ->where('entity_id', $this->entity_id)
            ->get();
    }

    public function lang(): BelongsTo {
        return $this->belongsTo(Langs::class);
    }
}
