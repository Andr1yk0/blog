<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GoogleAdd extends Component
{
    public int $slotId;
    public string $format = 'auto';
    public function render(): View|Closure|string
    {
        return view('components.google-add');
    }
}
