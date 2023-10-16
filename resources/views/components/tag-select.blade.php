<div x-data="{
    tags: {{ $tags }},
    search: '',
    selectedTags: {{ $selectedTags }},
    showOptions: false,
    get filteredTags(){
        if(this.search === ''){
            return this.availableTags;
        }
        return this.availableTags.filter(tag => tag.title.toLowerCase().includes(this.search.toLowerCase()));
    },
    get availableTags(){
        return this.tags.filter(tag => !this.selectedTags.some(selectedTag => selectedTag.id === tag.id));
    },
    get selectedTagsIds(){
        return this.selectedTags.map(tag => tag.id).join(',');
    },
    selectTagHandler(tag){
        if(this.selectedTags.some(selectedTag => selectedTag.id === tag.id)){
            this.selectedTags = this.selectedTags.filter(selectedTag => selectedTag.id !== tag.id);
        }else{
            this.selectedTags.push(tag);
        }
        this.search = '';
        this.showOptions = false;
    }
}">
    <label for="tagSearch" class="block text-sm font-medium leading-6 text-gray-900">Tags</label>
    <input type="hidden" name="tags" x-model="selectedTagsIds">
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
            id="tagSearch"
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
            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                      d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
                      clip-rule="evenodd"/>
            </svg>
        </button>

        <ul class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
            id="options"
            role="listbox"
            x-show="showOptions"
        >
            <template x-for="tag in filteredTags">
                <li class="relative cursor-pointer select-none py-2 pl-3 pr-9 text-gray-900 hover:bg-indigo-600 hover:text-white"
                    id="option-0"
                    role="option"
                    tabindex="-1"
                    @click="selectTagHandler(tag)"
                    x-data="{
                        get selected(){
                            return $data.selectedTags.some(selectedTag => selectedTag.id === tag.id);
                        }
                    }"
                >
                    <div class="flex items-center">
                        <span class="ml-3 truncate" :class="{ 'font-semibold': selected }" x-text="tag.title"></span>
                    </div>
                    <span x-show="selected" class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"
                            />
                        </svg>
                    </span>
                </li>
            </template>
        </ul>
    </div>
</div>


@push('scripts')
    <script src="{{asset('js/admin/tag-select.js')}}"></script>
@endpush
