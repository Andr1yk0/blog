@extends('layouts.admin')
@section('content')
    <div class="px-2">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Posts</h1>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a type="button"
                   href="{{route('admin.posts.create')}}"
                   class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                    Add post
                </a>
            </div>
        </div>
        <form
            x-data="postsFilter('{{request("filter.title", "")}}', '{{request("filter", "")["tags.title"] ?? ""}}')"
            class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 bg-gray-100 p-4 rounded-md"
        >
            <div class="sm:col-span-3">
                <label for="titleFilter" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                <div class="mt-2">
                    <input
                        @input.debounce.600ms="$event.target.closest('form').submit()"
                        x-model="title"
                        type="text"
                        name="filter[title]"
                        id="titleFilter"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    >
                </div>
            </div>
            <div class="sm:col-span-3">
                <label for="tagFilter" class="block text-sm font-medium leading-6 text-gray-900">Tag</label>
                <div class="mt-2">
                    <input
                        @input.debounce.600ms="$event.target.closest('form').submit()"
                        x-model="tagTitle"
                        type="text"
                        name="filter[tags.title]"
                        id="tagFilter"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    >
                </div>
            </div>
        </form>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                        <tr>
                            <x-admin-table-header title="ID" sortBy="id"/>
                            <x-admin-table-header title="Photo"/>
                            <x-admin-table-header title="Title" sortBy="title"/>
                            <x-admin-table-header title="Slug" sortBy="slug"/>
                            <x-admin-table-header title="Tags"/>
                            <x-admin-table-header title="Published" sortBy="published_at"/>
                            <x-admin-table-header title="Created" sortBy="created_at"/>
                            <x-admin-table-header title="Updated" sortBy="updated_at"/>
                            <x-admin-table-header title="Actions"/>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @foreach($posts as $post)
                            <tr>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$post->id}}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">
                                    @if($post->image_url)
                                        <img src="{{$post->image_url}}">
                                    @endif
                                </td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{$post->title}}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{$post->slug}}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{$post->tags->pluck('title')->join(', ')}}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{$post->published_at}}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{$post->created_at}}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{$post->updated_at}}</td>
                                <td>
                                    <a class="cursor-pointer" href="{{route('admin.posts.edit', [$post->id])}}">
                                        <x-icons.mini.pencil-square class="text-indigo-500 hover:text-indigo-700"/>
                                    </a>
                                    <form method="POST" action="{{route('admin.posts.destroy', $post->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <a class="cursor-pointer"
                                           onclick="if(confirm('Are you sure you want to delete this post?')){this.closest('form').submit()}"
                                        >
                                            <x-icons.mini.trash class="text-red-500 hover:text-red-700"/>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{$posts->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        Alpine.data('postsFilter', (title, tagTitle) => ({
            title: title,
            tagTitle: tagTitle
        }))
    </script>
@endpush
