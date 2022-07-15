<?php

declare(strict_types=1);

namespace App\Core\Components;

use Domain\Deck\DTO\DeckDTO;
use Illuminate\View\Component;

class App extends Component
{
    
    public function __construct(
        private  $deck = null
    ){}
    
    public function render()
    {
        //dd($this->deck);
        return view('components.app',[
            'deck' => $this->deck
        ]);
    }
}
