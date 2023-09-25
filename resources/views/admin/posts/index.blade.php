@extends('layouts.admin')
@section('header')
    <h1>Posts</h1>
    <a href="{{route('admin.posts.create')}}" class="btn btn-success">Create Post</a>
@endsection
@section('content')
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Tags</th>
            <th>Published</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->slug}}</td>
                    <td>{{$post->tags->pluck('title')->join(', ')}}</td>
                    <td>{{$post->published_at}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>{{$post->updated_at}}</td>
                    <td>
                        <a href="{{route('admin.posts.edit', [$post->id])}}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-fill"></i></a>
                        <a class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $posts->links() !!}
@endsection
