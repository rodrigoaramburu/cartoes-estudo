<?php

declare(strict_types=1);

namespace App\Core\Components;

use Illuminate\View\Component;

class App extends Component
{
    public function render()
    {
        return view('components.app');
    }
}
