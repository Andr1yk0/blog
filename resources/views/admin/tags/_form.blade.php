<form class="row" method="post" action="{{$formAction}}" id="editTagForm">
    @csrf
    @if(isset($tag))
        @method('PUT')
    @endif
    <div class="mb-2">
        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
        <div class="mt-2">
            <input
                type="text"
                name="title"
                value="{{ $tag->title ?? old('title') }}"
                id="title"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            />
        </div>
    </div>
    <div class="mb-2">
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Slug</label>
        <x-slug-input :slug="$tag->slug ?? old('slug', '')"/>
    </div>
    <div class="mb-2">
        <label class="block text-sm font-medium leading-6 text-gray-900"></label>
        <x-tag-select
            :selectedTags="$tag->subTags ?? new \Illuminate\Database\Eloquent\Collection([])"
            :label="'Sub tags'"
            :inputName="'sub_tags'"
        />
    </div>
    <div class="text-center">
        <button type="submit" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
</form>
