@extends('layouts.admin')
@section('content')
    <div class="px-2">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Media</h1>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <div>
                            <input type="file" name="file" required>
                        </div>
                        <div class="flex rounded-md shadow-sm">
                            <div class="relative flex flex-grow items-stretch focus-within:z-10">
                                <input type="text" required value="posts/images" name="path"
                                       class="block w-full rounded-none rounded-l-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            <button type="submit"
                                    class="relative -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                Upload
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                        <tr>
                            <x-admin-table-header title="Path" sortBy="path"/>
                            <x-admin-table-header title="Size" sortBy="size"/>
                            <x-admin-table-header title="Modified" sortBy="lastModified"/>
                            <x-admin-table-header title="Actions"/>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @foreach($mediaFiles as $mediaFile)
                            <tr>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$mediaFile['path']}}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{$mediaFile['fileSize']}}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{\Carbon\Carbon::createFromTimestamp($mediaFile['lastModified'])->format('Y-m-d H:i:s')}}</td>
                                <td>
                                    <form action="{{route('admin.media.destroy')}}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="path" value="{{$mediaFile['path']}}">
                                        <a
                                            onclick="if(confirm('Are you sure you want to delete media?')){this.closest('form').submit()}"
                                            class="inline-block"
                                        >
                                            <x-icons.mini.trash class="text-red-500 hover:text-red-700"/>
                                        </a>
                                    </form>
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
