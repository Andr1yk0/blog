<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ThemeSwitch extends Component
{
    public array $themes = [
        [
            'title' => 'Teal',
            'name' => 'teal'
        ],
        [
            'title' => 'Blue',
            'name' => 'blue'
        ],
        [
            'title' => 'Indigo',
            'name' => 'indigo'
        ],
        [
            'title' => 'Amber',
            'name' => 'amber'
        ],
        [
            'title' => 'Rose',
            'name' => 'rose'
        ],
        [
            'title' => 'Stone',
            'name' => 'stone'
        ]
    ];

    public function render(): View|Closure|string
    {
        return view('components.theme-switch');
    }
}