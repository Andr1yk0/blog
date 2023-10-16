<form class="row" method="post" action="{{$formAction}}" id="editPostForm" novalidate>
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
        <div class="mt-2 flex rounded-md shadow-sm">
            <div class="relative flex flex-grow items-stretch focus-within:z-10">
                <input
                    type="text"
                    id="slug"
                    name="slug"
                    value="{{$post->slug ?? old('slug')}}"
                    class="block w-full rounded-none rounded-l-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
            </div>
            <button type="button"
                    id="generateSlugBtn"
                    class="relative -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
            >
                Generate
            </button>
        </div>
    </div>
    <div class="mb-2">
        <label>Body</label>
        <div id="editor"></div>
        <input type="hidden" name="body_html">
        <input type="hidden" name="body_markdown" value="{{ $post->body_markdown ?? old('body_markdown') }}">
    </div>
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
        <x-tag-select :selected-tags="$post->tags"/>
    </div>
    <div class="text-center">
        <button type="submit" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
</form>
@push('scripts')
    <script src="{{asset('js/admin/edit-post-form.js')}}"></script>
@endpush
