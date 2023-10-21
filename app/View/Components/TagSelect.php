<?php

namespace App\View\Components;

use App\Models\Tag;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class TagSelect extends Component
{
    public function __construct(
        public Collection $selectedTags,
        public string $inputName = 'tags',
        public string $label = 'Tags',
    ){}

    public function render(): View|Closure|string
    {
        $tags = Tag::all();
        return view('components.tag-select', compact('tags'));
    }
}
