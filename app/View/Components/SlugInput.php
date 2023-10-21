<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SlugInput extends Component
{
    public function __construct(public string $slug = '', public string $textInputId = 'title')
    {

    }

    public function render(): View|Closure|string
    {
        return view('components.slug-input');
    }
}
