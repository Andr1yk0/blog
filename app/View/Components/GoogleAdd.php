<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Throwable;
use Exception;

class GoogleAdd extends Component
{
    public int $slotId;
    public function render(): View|Closure|string
    {
        return view('components.google-add');
    }
}
