<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tag extends Component
{
    public function __construct(public \App\Models\Tag $tag)
    {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.tag');
    }
}
