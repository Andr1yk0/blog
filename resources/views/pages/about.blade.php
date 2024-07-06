@extends('layouts.app')
@section('content')
    <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8 my-10">
        <div class="grid grid-cols-1 items-start gap-x-8 gap-y-8 lg:grid-cols-2">
            <x-card>
                <x-slot:header>
                    <h1 class="text-base font-semibold leading-6 text-text-clr-800">About prostocode.com</h1>
                </x-slot>
                <div class="prose prose-base text-text-clr-600">
                    prostocode.com - a personal blog about web development technologies.
                    I write short posts about problems and solutions that I encounter in my work.
                    Writing helps me to structure my knowledge, share it with others and gives me motivation to explore
                    new things.
                </div>
            </x-card>
            <x-card>
                <x-slot:header>
                    <h2 class="text-base font-semibold leading-6 text-text-clr-800">About the author</h2>
                </x-slot>
                <div class="prose prose-base text-text-clr-600">
                    I'm a full-stack web developer from Lviv, Ukraine.
                    I have {{ $experienceYears }}+ years of experience in
                    building web applications with PHP and JavaScript.
                </div>
            </x-card>
            <x-experience-heatmap />
        </div>
    </div>
@endsection
