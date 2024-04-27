<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainHeader extends Component
{
    public array $menuItems = [];

    public function __construct()
    {
        $this->menuItems = [
            [
                'title' => 'About',
                'url' => route('about'),
                'is_active' => request()->routeIs('about'),
            ],
            [
                'title' => 'Posts',
                'url' => route('posts.index'),
                'is_active' => request()->routeIs('posts.*'),
            ],
            [
                'title' => 'Contacts',
                'url' => route('contacts.index'),
                'is_active' => request()->routeIs('contacts.index'),
            ],
        ];
    }

    public function render(): View|Closure|string
    {
        return view('components.main-header');
    }
}
