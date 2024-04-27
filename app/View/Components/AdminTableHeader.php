<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminTableHeader extends Component
{
    public function __construct(
        public string $title,
        public ?string $sortBy = null,
        public string $url = '',
        public string $sortDirection = 'asc'
    ) {
        if (request()->get('sort') === $this->sortBy) {
            $this->url = '?sort=-'.$this->sortBy;
        } else {
            $this->url = '?sort='.$this->sortBy;
        }

        if (request()->get('sort') === '-'.$this->sortBy) {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }
    }

    public function isSorted(): bool
    {
        return request()->get('sort') === $this->sortBy || request()->get('sort') === '-'.$this->sortBy;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin-table-header');
    }
}
