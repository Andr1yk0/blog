<div x-data="tagSelect({{$tags}}, {{$selectedTags}}, '{{$inputName}}', '{{$label}}')">
    <label :for="$id('tagSearch')" x-text="label" class="block text-sm font-medium leading-6 text-gray-900"></label>
    <input type="hidden" :name="inputName" x-model="selectedTagsIds">
    <div class="inline-flex gap-x-1" x-show="selectedTags.length">
        <template x-for="tag in selectedTags">
            <span
                class="inline-flex items-center gap-x-0.5 rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-600 ring-1 ring-inset ring-indigo-500/10">
                <span x-text="tag.title"></span>
                <button @click="selectTagHandler(tag)" type="button"
                        class="group relative -mr-1 h-3.5 w-3.5 rounded-sm hover:bg-indigo-500/20">
                    <span class="sr-only">Remove</span>
                    <svg viewBox="0 0 14 14" class="h-3.5 w-3.5 stroke-indigo-600/50 group-hover:stroke-indigo-600/75">
                        <path d="M4 4l6 6m0-6l-6 6"/>
                    </svg>
                    <span class="absolute -inset-1"></span>
                </button>
            </span>
        </template>
    </div>
    <div class="relative mt-2" @click.outside="showOptions = false">
        <input
            :id="$id('tagSearch')"
            type="text"
            x-model="search"
            class="w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-12 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            role="combobox"
            placeholder="Search tag"
            aria-controls="options"
            aria-expanded="false"
            @focusin="showOptions = true"
        >
        <button type="button" class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
            <x-icons.mini.chevron-up-down />
        </button>

        <ul class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
            id="options"
            role="listbox"
            x-show="showOptions"
        >
            <template x-for="tag in filteredTags">
                <li class="relative cursor-pointer select-none py-2 pl-3 pr-9 text-gray-900 hover:bg-indigo-600 hover:text-white"
                    :id="$id('option')"
                    role="option"
                    tabindex="-1"
                    @click="selectTagHandler(tag)"
                >
                    <div class="flex items-center">
                        <span class="ml-3 truncate" x-text="tag.title"></span>
                    </div>
                </li>
            </template>
        </ul>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('js/components/tag-select.js') }}"></script>
@endpush
