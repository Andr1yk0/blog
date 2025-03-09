@extends('layouts.admin')
@section('content')
    <div class="px-2">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Tags</h1>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a href="{{route('admin.tags.create')}}"
                   class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Add tag
                </a>
            </div>
        </div>
        <form
            x-data="postsFilter('{{request("filter.title", "")}}', '{{request("filter.slug", "")}}')"
            class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 bg-gray-100 p-4 rounded-md"
        >
            <x-table-filter
                label="Title"
                inputId="titleFilter"
                inputName="filter[title]"
                xModel="title"
                class="sm:col-span-3"
            />
            <x-table-filter
                label="Slug"
                inputId="slugFilter"
                inputName="filter[slug]"
                xModel="slug"
                class="sm:col-span-3"
            />
        </form>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                        <tr>
                            <x-admin-table-header title="ID" sortBy="id"/>
                            <x-admin-table-header title="Title" sortBy="title"/>
                            <x-admin-table-header title="Slug" sortBy="slug"/>
                            <x-admin-table-header title="Description" sortBy="description"/>
                            <x-admin-table-header title="Posts count" sortBy="posts_count"/>
                            <x-admin-table-header title="Created" sortBy="created_at"/>
                            <x-admin-table-header title="Updated" sortBy="updated_at"/>
                            <x-admin-table-header title="Actions"/>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @forelse($tags as $tag)
                            <tr>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $tag->id }}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{ $tag->title }}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{ $tag->slug }}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{ $tag->description }}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{ $tag->posts_count }}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{ $tag->created_at }}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{ $tag->updated_at }}</td>
                                <td>
                                    <a href="{{ route('admin.tags.edit', [$tag->id]) }}"
                                       class="inline-block cursor-pointer"
                                    >
                                        <x-icons.mini.pencil-square class="text-indigo-500 hover:text-indigo-700"/>
                                    </a>
                                    <form action="{{route('admin.tags.destroy', $tag->id)}}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a
                                            onclick="if(confirm('Are you sure you want to delete the tag?')){this.closest('form').submit()}"
                                            class="inline-block cursor-pointer">
                                            <x-icons.mini.trash class="text-red-500 hover:text-red-700"/>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td class="text-center p-2" colspan="8">No tags found</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{$tags->onEachSide(1)->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        Alpine.data('postsFilter', (title, slug) => ({
            title: title,
            slug: slug
        }))
    </script>
@endpush
