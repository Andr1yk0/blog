@extends('layouts.admin')
@section('content')
    <x-admin-page-header>Create post</x-admin-page-header>
    @include('admin.posts._form')
@endsection
