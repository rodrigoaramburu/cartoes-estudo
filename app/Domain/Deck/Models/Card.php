<?php

declare(strict_types=1);

namespace Domain\Deck\Models;

use DateTime;
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
    ];

    protected $casts = [
        'next_revision' =>  DateTime::class,
    ];

    public function deck(): BelongsTo
    {
        return $this->belongsTo(Deck::class);
    }
}
