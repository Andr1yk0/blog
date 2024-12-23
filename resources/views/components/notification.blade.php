{{--<div x-data--}}
{{--     aria-live="assertive"--}}
{{--     class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6 z-50"--}}
{{-->--}}
{{--    <div class="flex w-full flex-col items-center space-y-4 sm:items-end">--}}
{{--        <!----}}
{{--          Notification panel, dynamically insert this into the live region when it needs to be displayed--}}

{{--          Entering: "transform ease-out duration-300 transition"--}}
{{--            From: "translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"--}}
{{--            To: "translate-y-0 opacity-100 sm:translate-x-0"--}}
{{--          Leaving: "transition ease-in duration-100"--}}
{{--            From: "opacity-100"--}}
{{--            To: "opacity-0"--}}
{{--        -->--}}
{{--        <template x-for="(notification, index) in $store.notifications.items">--}}
{{--            <div class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-text-clr-100 shadow-lg ring-1 ring-black ring-opacity-5">--}}
{{--                <div class="p-4">--}}
{{--                    <div class="flex items-start">--}}
{{--                        <div class="flex-shrink-0">--}}
{{--                            <x-icons.outline.check-circle x-show="notification.type === 'success'" class="text-green-400" />--}}
{{--                            <x-icons.outline.x-circle x-show="notification.type === 'error'" class="text-red-400" />--}}
{{--                        </div>--}}
{{--                        <div class="ml-3 w-0 flex-1 pt-0.5">--}}
{{--                            <p class="text-sm font-medium text-text-clr-900" x-text="notification.message"></p>--}}
{{--                            <p class="mt-1 text-sm text-text-clr-500" x-text="notification.description"></p>--}}
{{--                        </div>--}}
{{--                        <div class="ml-4 flex flex-shrink-0">--}}
{{--                            <button @click="$store.notifications.remove(index)" type="button" class="inline-flex rounded-md text-text-clr-400 hover:text-text-clr-500">--}}
{{--                                <span class="sr-only">Close</span>--}}
{{--                                <x-icons.mini.x-mark />--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </template>--}}
{{--    </div>--}}
{{--</div>--}}
<div
    class="fixed right-4 top-4 z-50 flex w-72 flex-col-reverse gap-2 sm:w-96"
>
    <!--
      Transitions for each notification div container

      Show/Hide with transitions
        enter         'transition linear duration-200'
        enter-start   'opacity-0 -translate-y-20' (if position is set to 'top-start' or 'top-end')
        enter-start   'opacity-0 translate-y-20' (if position is set to 'bottom-start' or 'bottom-end')
        enter-end     'opacity-100 translate-y-0'
        leave         'transition linear duration-200'
        leave-start   'opacity-100 translate-y-0'
        leave-end     'opacity-0 translate-y-20' (if position is set to 'top-start' or 'top-end')
        leave-end     'opacity-0 -translate-y-20' (if position is set to 'bottom-start' or 'bottom-end')
    -->

    <!-- Success Notification -->
    <template x-for="(notification, index) in $store.notifications.items">
        <div
            class="flex items-center justify-between gap-4 rounded-xl border border-gray-200 bg-white p-5 text-sm shadow-md shadow-gray-200/50 dark:border-gray-700/75 dark:bg-gray-800 dark:shadow-gray-950/50"
            role="alert"
            aria-live="polite"
        >
            <div
                class="flex size-11 flex-none items-center justify-center rounded-xl"
                :class="{
                    'bg-green-100 text-green-700 dark:bg-green-600/25 dark:text-green-100': notification.type === 'success',
                    'bg-rose-100 text-rose-700 dark:bg-rose-600/25 dark:text-rose-100': notification.type === 'error'
                }"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 16 16"
                    fill="currentColor"
                    class="hi-micro hi-check inline-block size-4"
                    x-show="notification.type === 'success'"
                >
                    <path
                        fill-rule="evenodd"
                        d="M12.416 3.376a.75.75 0 0 1 .208 1.04l-5 7.5a.75.75 0 0 1-1.154.114l-3-3a.75.75 0 0 1 1.06-1.06l2.353 2.353 4.493-6.74a.75.75 0 0 1 1.04-.207Z"
                        clip-rule="evenodd"
                    />
                </svg>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 16 16"
                    fill="currentColor"
                    class="hi-micro hi-x-mark inline-block size-4"
                    x-show="notification.type === 'error'"
                >
                    <path
                        d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z"
                    />
                </svg>
            </div>
            <div class="flex flex-grow flex-col gap-0.5">
                <h5 class="font-semibold" x-text="notification.message"></h5>
                <p class="dark:text-gray-400" x-text="notification.description"></p>
            </div>
            <button
                type="button"
                class="flex-none text-gray-500 hover:text-gray-700 active:text-gray-500 dark:text-gray-400 dark:hover:text-gray-300 dark:active:text-gray-400"
                @click="$store.notifications.remove(index)"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    class="hi-mini hi-x-mark inline-block size-5"
                    aria-hidden="true"
                >
                    <path
                        d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z"
                    />
                </svg>
                <span class="sr-only">Close Notification</span>
            </button>
        </div>
    </template>
</div>
@push('scripts')
    <script>
        const notifications = @json($notifications);
        if (notifications) {
            Alpine.store('notifications').items = notifications;
            notifications
                .filter(notification => notification.timeout)
                .forEach(notification => {
                    setTimeout(() => {
                        Alpine.store('notifications').remove(notification.id);
                    }, notification.timeout);
                });
        }
    </script>
@endpush
