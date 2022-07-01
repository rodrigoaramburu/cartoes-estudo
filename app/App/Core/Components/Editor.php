<?php

declare(strict_types=1);

namespace App\Core\Components;

use Illuminate\View\Component;

class Editor extends Component
{
    public function __construct(
        public ?string $name = null,
        public ?string $label = null
    ) {
    }

    public function render()
    {
        return view('components.editor');
    }
}
