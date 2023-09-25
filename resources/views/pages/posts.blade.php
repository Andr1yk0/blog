@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <x-card>
                <x-slot:body>
                    @foreach($tags as $tag)
                        <a class="btn btn-secondary btn-sm mb-2 me-2">
                            {{$tag->title}} <span class="badge bg-light text-secondary">{{$tag->posts_count}}</span>
                        </a>
                    @endforeach
                </x-slot>
            </x-card>
        </div>
        <div class="col-lg-8">
            <x-card>
                <x-slot:body></x-slot>
            </x-card>
        </div>
    </div>
@endsection
