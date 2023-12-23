@extends('layouts.admin')
@section('content')
    <div class="px-2">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Settings</h1>
            </div>
        </div>
    </div>
    <div class="mt-8 flow-root">
        <div class="bg-gray-50 shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-base font-semibold leading-6 text-gray-900">Sitemap</h3>
                <div class="mt-5 flex content-start gap-2">
                    <form x-data action="{{ route('admin.settings.generate-sitemap') }}" method="POST" @submit="$store.loader = true">
                        @csrf
                        <button type="submit" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Generate</button>
                    </form>
                    <a href="/sitemap.xml" target="_blank" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Preview</a>
                </div>
            </div>
        </div>
    </div>
@endsection
