@extends('layouts.admin')
@section('content')
    <div class="px-2">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Contact requests</h1>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                        <tr>
                            <x-admin-table-header title="ID" sortBy="id"/>
                            <x-admin-table-header title="Name" sortBy="name"/>
                            <x-admin-table-header title="Email" sortBy="email"/>
                            <x-admin-table-header title="Message"/>
                            <x-admin-table-header title="Score" />
                            <x-admin-table-header title="Created" sortBy="created_at"/>
                            <x-admin-table-header title="Actions"/>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @foreach($contactRequests as $contactRequest)
                            <tr>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$contactRequest->id}}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{$contactRequest->name}}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{$contactRequest->email}}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{$contactRequest->message}}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{$contactRequest->captcha_score}}</td>
                                <td class="px-3 py-4 text-sm text-gray-500">{{$contactRequest->created_at}}</td>
                                <td>
                                    <form action="{{route('admin.contact-requests.destroy', $contactRequest->id)}}"
                                          method="POST"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <a
                                            onclick="if(confirm('Delete contact request?')){this.closest('form').submit()}"
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
                    <div class="mt-4">
                        {{$contactRequests->onEachSide(1)->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
