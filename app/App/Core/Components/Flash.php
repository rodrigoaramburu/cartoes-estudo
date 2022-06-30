<?php

declare(strict_types=1);

namespace App\Core\Components;

use Illuminate\View\Component;

class Flash extends Component
{
    public function __construct(
        public ?string $message = null
    ) {
    }

    public function render()
    {
        return view('components.flash');
    }
}
