<form x-data class="row" method="post" action="{{$formAction}}" id="editPostForm" novalidate>
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
                value="{{ old('title', $post->title ?? '') }}"
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
        <label>Body</label>
        <div id="editor"></div>
        <input type="hidden" name="body_html">
        <input type="hidden" name="body_markdown" value="{{ old('body_markdown', $post->body_markdown ?? '') }}">
    </div>
    <template x-if="$store.editPostForm.postDescriptionLength < 100 || $store.editPostForm.postDescriptionLength > 170">
        <div  class="border-l-4 border-yellow-400 bg-yellow-50 p-4">
            <div class="flex">
                <p class="text-sm text-yellow-700">
                    Description size is: <span x-text="$store.editPostForm.postDescriptionLength"></span> characters
                </p>
            </div>
        </div>
    </template>
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
    <script src="{{asset('js/admin/edit-post-form.js')}}"></script>
@endpush
