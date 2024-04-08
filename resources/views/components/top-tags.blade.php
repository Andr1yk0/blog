<x-card {{$attributes}}>
    <x-slot:header>
        <h3 class="text-base font-semibold leading-6 text-text-clr-900">Top tags</h3>
    </x-slot>
    <div class="flex flex-wrap gap-1">
        @foreach($tags as $tag)
            <x-tag :tag="$tag"/>
        @endforeach
    </div>
</x-card>
