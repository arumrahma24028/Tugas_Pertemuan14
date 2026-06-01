<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BukuCard extends Component
{
    public $buku;
    public $showActions;

    /**
     * Create a new component instance.
     */
    public function __construct($buku, $showActions = true)
    {
        $this->buku = $buku;
        // Memastikan nilai berupa boolean walaupun dikirim dalam bentuk string dari blade binding
        $this->showActions = filter_var($showActions, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.buku-card');
    }
}