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
                'title' => 'Tags',
                'url' => route('admin.tags.index'),
                'is_active' => request()->routeIs('admin.tags.*')
            ],
            [
                'title' => 'Contact requests',
                'url' => route('admin.contact-requests.index'),
                'is_active' => request()->routeIs('admin.contact-requests.*')
            ],
            [
                'title' => 'Media',
                'url' => route('admin.media.index'),
                'is_active' => request()->routeIs('admin.media.*')
            ],
            [
                'title' => 'Logs',
                'url' => route('log-viewer.index'),
                'is_active' => request()->routeIs('log-viewer.*')
            ]
        ];
    }

    public function render(): View|Closure|string
    {
        return view('components.admin-sidebar');
    }
}
