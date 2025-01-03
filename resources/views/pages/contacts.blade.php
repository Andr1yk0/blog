@extends('layouts.app')
@section('content')
    <!-- Contact Section: Simple Boxed -->
    <div class="bg-gray-100 dark:bg-gray-900 dark:text-gray-100">
        <div
            class="container mx-auto space-y-16 px-4 py-16 lg:px-8 lg:py-32 xl:max-w-7xl"
        >
            <div class="text-center">
                <div
                    class="mb-1 text-sm font-bold uppercase tracking-wider text-clr-600 dark:text-clr-500"
                >
                    Any questions?
                </div>
                <h2 class="mb-4 text-4xl font-black tex t-black dark:text-white">
                    Contact me
                </h2>
                <h3
                    class="mx-auto text-xl font-medium leading-relaxed text-gray-700 lg:w-2/3 dark:text-gray-300"
                >
                    Feel free to get in touch and I will get back to your as soon as possible.
                </h3>
            </div>
            <div
                class="mx-auto flex w-full max-w-xl flex-col overflow-hidden rounded-lg bg-white shadow-sm dark:bg-gray-800 dark:text-gray-100"
            >
                <form
                    action="{{ route('contacts.store') }}"
                    class="space-y-6 p-5 md:p-10"
                    id="contactForm"
                    method="POST"
                >
                    @csrf
                    <div class="space-y-1">
                        <label for="name" class="font-medium">Your name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            autocomplete="given-name"
                            class="block w-full rounded-lg border border-gray-200 px-5 py-3 leading-6 placeholder-gray-500 focus:border-clr-500 focus:ring focus:ring-clr-500/50 dark:border-gray-600 dark:bg-gray-800 dark:placeholder-gray-400 dark:focus:border-clr-500 dark:autofill:text-white"
                        />
                    </div>
                    <div class="space-y-1">
                        <label for="email" class="font-medium">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            autocomplete="email"
                            value="{{ old('email') }}"
                            class="block w-full rounded-lg border border-gray-200 px-5 py-3 leading-6 placeholder-gray-500 focus:border-clr-500 focus:ring focus:ring-clr-500/50 dark:border-gray-600 dark:bg-gray-800 dark:placeholder-gray-400 dark:focus:border-clr-500"
                        />
                    </div>
                    <div class="space-y-1">
                        <label for="message" class="font-medium">Message</label>
                        <textarea
                            id="message"
                            name="message"
                            rows="6"
                            class="block w-full rounded-lg border border-gray-200 px-5 py-3 leading-6 placeholder-gray-500 focus:border-clr-500 focus:ring focus:ring-clr-500/50 dark:border-gray-600 dark:bg-gray-800 dark:placeholder-gray-400 dark:focus:border-clr-500"
                        >{{ old('message') }}</textarea>
                    </div>
                    <button
                        data-action="submit"
                        data-callback="onSubmit"
                        data-sitekey="{{ config('captcha.site_key') }}"
                        type="submit"
                        class="g-recaptcha inline-flex w-full items-center justify-center gap-2 rounded-lg border border-clr-700 bg-clr-700 px-8 py-4 font-semibold leading-6 text-white hover:border-clr-600 hover:bg-clr-600 hover:text-white focus:ring focus:ring-clr-400/50 active:border-clr-700 active:bg-clr-700 dark:focus:ring-clr-400/90"
                    >
                        <svg
                            class="hi-mini hi-paper-airplane inline-block size-5 opacity-50"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                d="M3.105 2.289a.75.75 0 00-.826.95l1.414 4.925A1.5 1.5 0 005.135 9.25h6.115a.75.75 0 010 1.5H5.135a1.5 1.5 0 00-1.442 1.086l-1.414 4.926a.75.75 0 00.826.95 28.896 28.896 0 0015.293-7.154.75.75 0 000-1.115A28.897 28.897 0 003.105 2.289z"
                            />
                        </svg>
                        <span>Send Message</span>
                    </button>
                </form>
            </div>
            <!-- END Contact Form -->
        </div>
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
