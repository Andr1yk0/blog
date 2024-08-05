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
        <div class="flex mt-2 items-start w-[600px]">
            <textarea
                name="image_text"
                rows="8"
                class="w-1/2 flex-1 block rounded-md bg-transparent border-0 px-3.5 py-2 text-text-clr-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-clr-600 sm:text-sm sm:leading-6"
                x-model="imageText"
            ></textarea>
            <select name="image_lang" x-model="selectedLang">
                <option value="" disabled>Select a language</option>
                <template x-for="lang in highlightLangs">
                    <option :selected="lang===selectedLang" :value="lang" x-text="lang"></option>
                </template>
            </select>
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
