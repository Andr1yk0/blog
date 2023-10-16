<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminSidebar extends Component
{
    public array $menuItems = [];

    public function __construct()
    {
        $this->menuItems = [
            [
                'title' => 'Dashboard',
                'url' => route('admin.dashboard'),
                'is_active' => request()->routeIs('admin.dashboard')
            ],
            [
                'title' => 'Posts',
                'url' => route('admin.posts.index'),
                'is_active' => request()->routeIs('admin.posts.*')
            ],
            [
                'title' => 'Tests',
                'url' => route('admin.tests.index'),
                'is_active' => request()->routeIs('admin.tests.*')
            ],
        ];
    }

    public function render(): View|Closure|string
    {
        return view('components.admin-sidebar');
    }
}
