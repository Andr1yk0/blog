<form x-data="editPostForm(`{{old('title', $post->title ?? '')}}`, `{{old('image_lang', $post->image_lang ?? '')}}`)"
      class="row"
      method="post"
      action="{{$formAction}}"
      id="editPostForm"
      novalidate
      enctype="multipart/form-data"
>
    @csrf
    @if(isset($post))
        @method('PUT')
    @endif
    <div class="mb-2">
        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
        <div class="mt-2">
            <input
                type="text"
                name="title"
                x-model="postTitle"
                id="title"
                autocomplete="given-name"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            />
        </div>
    </div>
    <div class="mb-2">
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Slug</label>
        <x-slug-input :slug="old('slug', $post->slug ?? '')"/>
    </div>
    <div class="mb-2">
        <button
            id="generateThumbnail"
            type="button"
            class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            @click="createImage"
            x-bind:disable="!selectedLang"
        >
            Generate image
        </button>
        <div class="flex gap-1 mt-2">
            <div class="bg-[#2e3440ff] w-[600px] h-[335px] relative pt-8" id="thumbnailPreview">
                <div class="bg-amber-200 absolute top-4 w-full p-4 text-gray-700 font-bold" x-text="postTitle"></div>
                <div class="flex h-full w-full items-center mt-4">
                    <div class="p-4 flex-grow align-middle" x-html="imageTextHighlighted"></div>
                </div>
                <div class="absolute bottom-0 right-0 text-amber-300 p-2 opacity-60">prostocode.com</div>
            </div>
            <img x-bind:src="base64Image">
        </div>
        <div class="mt-2 w-[600px]">
            <div
                x-data="{
    open: false,
    resetOnOpen: true,
    options: highlightLangs,
    filterTerm: '',
    filterResults: [],
    highlightedOption: null,
    highlightedIndex: -1,
    enableMouseHighlighting: true,

    init() {
      if(this.selectedLang){
        this.filterTerm = this.selectedLang;
      }
      if (this.open) {
        this.openCommandPalette();
      }
      this.filterResults = this.options;
    },

    // Open Command Palette
    openCommandPalette() {
      if (this.resetOnOpen) {
        this.filterTerm = '';
        this.highlightedOption = null;
        this.highlightedIndex = -1;
        this.filterResults = this.options;
      }

      this.open = true;
    },

    closeCommandPalette() {
      this.open = false;
    },

    // Enable mouse interaction
    enableMouseInteraction() {
      this.enableMouseHighlighting = true;
    },

    filter() {
      this.selectedLang = null;
      if (this.filterTerm === '') {
        this.filterResults = this.options;
      } else {
        this.filterResults = this.options.filter((option) => {
          return option.toLowerCase().includes(this.filterTerm.toLowerCase());
        });
      }

      // Refresh highlighted array index (the results have been updated)
      if (this.filterResults.length > 0 && this.highlightedOption) {
          this.highlightedIndex = this.filterResults.findIndex((option) => {
            return option === this.highlightedOption;
          });
        }
    },

    // Set an option as highlighted
    setHighlighted(id, mode) {
      if (id === null) {
        this.highlightedOption = null;
        this.highlightedIndex = -1;
      } else if (this.highlightedOption != id && (mode === 'keyboard' || (mode === 'mouse' && this.enableMouseHighlighting))) {
        this.highlightedOption = this.options.find(option => option === id) || null;

        // Set highlighted index of filter results
        if (mode === 'mouse' && this.enableMouseHighlighting) {
            this.highlightedIndex = this.filterResults.findIndex((option) => {
              return option === id;
            });
        } else {
          // We are in keyboard mode, disable mouse navigation
          this.enableMouseHighlighting = false;

          // Scroll listbox to make the highlighted element visible
          $refs.elListbox.querySelector('li[data-id=\'' + id + '\']').scrollIntoView({ block: 'nearest' });
        }
      }
    },

    // Check if the given id is the highlighted one
    isHighlighted(id) {
      return id === this.highlightedOption || false;
    },

    // Navigate results functionality
    navigateResults(mode) {
      if (this.filterResults.length > 0) {
        const maxIndex = this.filterResults.length - 1;

        if (mode === 'first') {
          this.highlightedIndex = 0;
        } else if (mode === 'last') {
          this.highlightedIndex = maxIndex;
        } else if (mode === 'previous') {
          if (this.highlightedIndex > 0 && this.highlightedIndex <= maxIndex) {
            this.highlightedIndex--;
          } else if (this.highlightedIndex === -1) {
            this.highlightedIndex = 0;
          }
        } else if (mode === 'next') {
          if (this.highlightedIndex >= 0 && this.highlightedIndex < maxIndex) {
            this.highlightedIndex++;
          } else if (this.highlightedIndex === -1) {
            this.highlightedIndex = 0;
          }
        }

        if (!this.filterResults[this.highlightedIndex]) {
          this.highlightedIndex = 0;
        }

        this.setHighlighted(this.filterResults[this.highlightedIndex], 'keyboard');
      }
    },

    // On option selected
    onOptionSelected(option) {
      const selectedOption = this.highlightedOption ? this.highlightedOption : option;
      this.selectedLang = selectedOption;
      this.filterTerm = selectedOption;
      this.open = false;
    },
  }"
            >
                <div
                    x-cloak
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-50 scale-95 translate-y-5"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-50 scale-95 translate-y-5"
                    x-on:click.outside="closeCommandPalette()"
                    class="mx-auto flex w-full max-w-lg flex-col dark:text-gray-100 relative"
                    role="document"
                >
                    <div
                        class="relative border border-gray-300 flex w-full items-center rounded-lg bg-white px-3 shadow-sm dark:bg-gray-900"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            class="hi-mini hi-magnifying-glass inline-block size-5 opacity-50"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <input
                            x-ref="elFilter"
                            x-model="filterTerm"
                            x-on:input.debounce.50ms="filter($event)"
                            x-on:keydown.enter.prevent.stop="onOptionSelected()"
                            x-on:keydown.up.prevent.stop="navigateResults('previous')"
                            x-on:keydown.down.prevent.stop="navigateResults('next')"
                            x-on:keydown.home.prevent.stop="navigateResults('first')"
                            x-on:keydown.end.prevent.stop="navigateResults('last')"
                            x-on:keydown.page-up.prevent.stop="navigateResults('first')"
                            x-on:keydown.page-down.prevent.stop="navigateResults('last')"
                            x-on:focus="open = true"
                            type="text"
                            class="w-full border-none bg-transparent py-3 placeholder:text-gray-500 focus:outline-none focus:ring-0 dark:placeholder:text-gray-400"
                            placeholder="Choose language"
                            tabindex="0"
                            role="combobox"
                            aria-expanded="true"
                            aria-autocomplete="list"
                        />
                    </div>
                    <ul
                        x-show="filterResults.length > 0 && open"
                        x-ref="elListbox"
                        x-on:mousemove.throttle="enableMouseInteraction()"
                        x-on:mouseleave="setHighlighted(null)"
                        class="mt-2 w-full top-[40px] max-h-72 z-1 overflow-auto rounded-lg bg-white py-3 shadow-xl dark:bg-gray-900 dark:shadow-black/25 absolute"
                        role="listbox"
                    >
                        <template x-for="option in filterResults" :key="option">
                            <li
                                x-on:click="onOptionSelected(option)"
                                x-on:mouseenter="setHighlighted(option, 'mouse')"
                                x-bind:class="{
              'text-gray-950 bg-blue-50 dark:text-white dark:bg-gray-800': isHighlighted(option),
              'text-gray-600 dark:text-gray-300': ! isHighlighted(option),
            }"
                                x-bind:data-selected="isHighlighted(option)"
                                x-bind:data-id="option"
                                x-bind:data-label="option"
                                x-bind:aria-selected="isHighlighted(option)"
                                class="group flex cursor-pointer items-center justify-between gap-2 px-3 text-sm"
                                role="option"
                                tabindex="-1"
                            >
                                <div x-text="option" class="grow truncate py-1.5"></div>
                            </li>
                        </template>
                    </ul>
                    <div
                        x-show="filterResults.length === 0"
                        class="mt-2 w-full top-[40px] absolute rounded-lg bg-white p-3 shadow-xl dark:bg-gray-900 dark:shadow-black/25"
                    >
                        <p class="py-1.5 z-1 text-sm text-gray-500 dark:text-gray-400">
                            No results
                        </p>
                    </div>
                </div>
            </div>
            <textarea
                name="image_text"
                rows="8"
                class="w-full block rounded-md bg-transparent border-0 px-3.5 py-2 text-text-clr-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-clr-600 sm:text-sm sm:leading-6"
                x-model="imageText"
            ></textarea>
        </div>
        <textarea name="base64_image" class="hidden" x-model="base64Image"></textarea>
    </div>
    <div class="mb-2">
        <label>Body</label>
        <div id="editor"></div>
        <input type="hidden" name="body_html">
        <input type="hidden" name="body_markdown" value="{{ old('body_markdown', $post->body_markdown ?? '') }}">
    </div>
    <div class="mb-2">
        <label>Description</label>
        <textarea
            name="meta_description"
            readonly
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>
    </div>
    <div class="mb-2">
        <label for="publishedAt" class="block text-sm font-medium leading-6 text-gray-900">Published at</label>
        <div class="mt-2">
            <input
                type="datetime-local"
                name="published_at"
                value="{{ old('published_at', $post->published_at ?? '') }}"
                id="publishedAt"
                autocomplete="given-name"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            />
        </div>
    </div>
    <div class="mb-2">
        <x-tag-select :selected-tags="$post->tags ?? new \Illuminate\Database\Eloquent\Collection()"/>
    </div>
    <div class="text-center">
        <button type="submit" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
</form>
@push('scripts')
    <script>
        window.imageText = @json(old('image_text', $post->image_text ?? ''));
    </script>
    <script src="{{asset('js/admin/edit-post-form.js')}}"></script>
@endpush
