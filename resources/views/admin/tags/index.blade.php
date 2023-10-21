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
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="table-fixed divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <x-admin-table-header title="ID" sortBy="id"/>
                                <x-admin-table-header title="Title" sortBy="title"/>
                                <x-admin-table-header title="Slug" sortBy="slug"/>
                                <x-admin-table-header title="Posts count" sortBy="posts_count"/>
                                <x-admin-table-header title="Created" sortBy="created_at"/>
                                <x-admin-table-header title="Updated" sortBy="updated_at"/>
                                <x-admin-table-header title="Actions"/>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @foreach($tags as $tag)
                            <tr>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $tag->id }}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{ $tag->title }}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{ $tag->slug }}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{ $tag->posts_count }}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{ $tag->created_at }}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{ $tag->updated_at }}</td>
                                <td>
                                    <a href="{{ route('admin.tags.edit', [$tag->id]) }}"
                                       class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <a class="text-red-600 hover:text-red-900" x-data="deleteTag"
                                       href="{{route('admin.tags.destroy', [$tag->id])}}" @click.prevent="deleteTag">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        Alpine.data('deleteTag', () => ({
            deleteTag(){
                if(confirm('Are you sure you want to delete this tag?')) {
                    axios.delete('{{ route('admin.tags.destroy', [$tag->id]) }}')
                        .then(() => {
                            window.location.reload();
                        });
                }
            }
        }));
    </script>
@endpush
