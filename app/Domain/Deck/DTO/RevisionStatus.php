<?php

declare(strict_types=1);

namespace Domain\Deck\DTO;

enum RevisionStatus:string
{
    case ERROR = 'ERROR';
    case HARD = 'HARD';
    case NORMAL = 'NORMAL';
    case EASY = 'EASY';
}
