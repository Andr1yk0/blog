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
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="table-fixed divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <x-admin-table-header title="ID" sortBy="id"/>
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
                                <td class="px-3 py-4 text-sm text-gray-500">{{$post->title}}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{$post->slug}}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{$post->tags->pluck('title')->join(', ')}}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{$post->published_at}}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{$post->created_at}}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{$post->updated_at}}</td>
                                <td>
                                    <a href="{{route('admin.posts.edit', [$post->id])}}"
                                       class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <a class="text-red-600 hover:text-red-900">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--    {!! $posts->links() !!}--}}
@endsection
