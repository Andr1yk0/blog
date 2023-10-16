@extends('layouts.admin')

@section('content')
    <div class="md:flex md:items-center md:justify-between mb-3">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                Edit Post
            </h2>
        </div>
        <div class="mt-4 flex md:ml-4 md:mt-0">

        </div>
    </div>
    @include('admin.posts._form')
@endsection
