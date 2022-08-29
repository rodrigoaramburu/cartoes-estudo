<?php

declare(strict_types=1);

namespace Domain\Deck\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'deck_id',
        'front',
        'back',
        'next_revision',
        'last_interval',
    ];

    protected $casts = [
        'next_revision' => 'datetime',
    ];

    public function deck(): BelongsTo
    {
        return $this->belongsTo(Deck::class);
    }
}
