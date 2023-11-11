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
                value="{{ $post->title ?? old('title') }}"
                id="title"
                autocomplete="given-name"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            />
        </div>
    </div>
    <div class="mb-2">
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Slug</label>
        <x-slug-input :slug="$post->slug ?? old('slug', '')"/>
    </div>
    <div class="mb-2">
        <label>Body</label>
        <div id="editor"></div>
        <input type="hidden" name="body_html">
        <input type="hidden" name="body_markdown" value="{{ $post->body_markdown ?? old('body_markdown') }}">
    </div>
    <template x-if="$store.editPostForm.postDescriptionLength < 100 || $store.editPostForm.postDescriptionLength > 170">
        <div  class="border-l-4 border-yellow-400 bg-yellow-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        Description size is: <span x-text="$store.editPostForm.postDescriptionLength"></span> characters
                    </p>
                </div>
            </div>
        </div>
    </template>
    <div class="mb-2">
        <label for="publishedAt" class="block text-sm font-medium leading-6 text-gray-900">Published at</label>
        <div class="mt-2">
            <input
                type="datetime-local"
                name="published_at"
                value="{{ $post->published_at ?? old('published_at') }}"
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
