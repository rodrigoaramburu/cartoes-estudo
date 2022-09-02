<?php

declare(strict_types=1);

namespace Domain\Deck\Models;

use Domain\Util\EditorParser\EditorParser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected $appends = ['front_html','back_html'];

    protected $casts = [
        'next_revision' => 'datetime',
    ];

    public function deck(): BelongsTo
    {
        return $this->belongsTo(Deck::class);
    }

   public function getFrontHtmlAttribute(): string
   {
        $editorParser = new EditorParser();
        return $editorParser->parse($this->front);
   }

   public function getBackHtmlAttribute(): string
   {
        $editorParser = new EditorParser();

        return $editorParser->parse($this->back);
   }
}
