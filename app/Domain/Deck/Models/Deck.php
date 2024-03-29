<?php

declare(strict_types=1);

namespace Domain\Deck\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'hard_interval_factor',
        'normal_interval_factor',
        'easy_interval_factor',
    ];
}
