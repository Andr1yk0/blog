@extends('layouts.app')
@section('content')
    <div class="mx-auto max-w-2xl my-10">
        <x-card>
            <x-slot:header>
                <h1 class="text-3xl font-bold text-center tracking-tight text-text-clr-900 sm:text-2xl">Contact form</h1>
                </x-slot>
                <form action="{{ route('contacts.store') }}"
                      id="contactForm"
                      method="POST"
                      class="mx-auto mt-6 max-w-xl"
                >
                    @csrf
                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="name" class="block text-sm font-semibold leading-6 text-text-clr-800">Your
                                name</label>
                            <div class="mt-2.5">
                                <input type="text"
                                       name="name"
                                       id="name"
                                       autocomplete="given-name"
                                       value="{{ old('name') }}"
                                       class="block bg-transparent w-full rounded-md border-0 px-3.5 py-2 text-text-clr-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-clr-600 sm:text-sm sm:leading-6"
                                >
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="email" class="block text-sm font-semibold leading-6 text-text-clr-900">Email</label>
                            <div class="mt-2.5">
                                <input type="email"
                                       name="email"
                                       id="email"
                                       autocomplete="email"
                                       value="{{ old('email') }}"
                                       class="block w-full rounded-md border-0 bg-transparent px-3.5 py-2 text-text-clr-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-clr-600 sm:text-sm sm:leading-6"
                                >
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="message"
                                   class="block text-sm font-semibold leading-6 text-text-clr-900">Message</label>
                            <div class="mt-2.5">
                                <textarea name="message"
                                          id="message"
                                          rows="4"
                                          class="block w-full rounded-md bg-transparent border-0 px-3.5 py-2 text-text-clr-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-clr-600 sm:text-sm sm:leading-6"
                                >{{ old('message') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10">
                        <button type="submit"
                                data-action="submit"
                                data-callback="onSubmit"
                                data-sitekey="{{ config('captcha.site_key') }}"
                                class="g-recaptcha block w-full rounded-md bg-clr-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-clr-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-clr-600"
                        >
                            Let's talk
                        </button>
                    </div>
                </form>
        </x-card>
    </div>
@endsection
@push('scripts')
    <script src='https://www.google.com/recaptcha/api.js?render={{config('captcha.site_key')}}'></script>
    <script>
        function onSubmit() {
            Alpine.store('loader', true);
            document.getElementById("contactForm").submit();
        }
    </script>
@endpush
