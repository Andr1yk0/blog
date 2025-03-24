<div x-data="themeSwitch()" class="relative inline-block">
    <button
        type="button"
        class="inline-flex items-center justify-center rounded-lg border border-white/20 bg-transparent px-2 py-2 text-sm leading-5 font-semibold text-white hover:border-clr-500/75 focus:ring focus:ring-clr-600/60 active:border-clr-500/50 dark:focus:ring-clr-400/90"
        id="tk-dropdown"
        aria-haspopup="true"
        x-bind:aria-expanded="open"
        x-on:click="open = true"
    >
        <span
            class="mt-0.5 mr-0.5 inline-block size-4 rounded-full border-2 bg-clr-500 border-white dark:border-secondary-950"></span>
        <x-icons.mini.chevron-down class="opacity-50"/>
    </button>
    <div
        x-cloak
        x-trap="open"
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        x-on:click.outside="open = false"
        x-on:keydown.down.prevent="$focus.next()"
        x-on:keydown.up.prevent="$focus.prev()"
        x-on:keydown.home.prevent="$focus.first()"
        x-on:keydown.end.prevent="$focus.last()"
        x-on:keydown.escape.window="open = false"
        role="menu"
        aria-labelledby="tk-dropdown"
        class="absolute right-0 mt-2 w-32 origin-top-right rounded-lg shadow-xl dark:shadow-gray-900"
    >
        <div
            class="divide-y divide-gray-100 rounded-lg bg-white ring-1 ring-black/5 dark:divide-gray-700 dark:bg-gray-800 dark:ring-gray-700"
        >
            @foreach($themes as $theme)
                <a
                    x-on:click="selectThemeHandler"
                    data-theme="{{$theme['name']}}"
                    role="menuitem"
                    href="javascript:void(0)"
                    class="group flex items-center justify-between gap-2 rounded-lg border border-transparent px-2.5 py-2 text-sm font-medium text-gray-700 hover:bg-clr-50 hover:text-clr-800 active:border-clr-100 dark:text-gray-200 dark:hover:bg-gray-700/75 dark:hover:text-white dark:active:border-gray-600"
                >
                    <span
                        class="mt-0.5 mr-0.5 inline-block size-4 rounded-full border-2 bg-{{$theme['name']}}-500 border-white dark:border-secondary-950"></span>
                    <span class="grow">{{$theme['title']}}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('js/components/theme-switch.js') }}"></script>
@endpush