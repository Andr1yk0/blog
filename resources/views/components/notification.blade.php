<div x-data
     aria-live="assertive"
     class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6 z-50"
>
    <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
        <!--
          Notification panel, dynamically insert this into the live region when it needs to be displayed

          Entering: "transform ease-out duration-300 transition"
            From: "translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            To: "translate-y-0 opacity-100 sm:translate-x-0"
          Leaving: "transition ease-in duration-100"
            From: "opacity-100"
            To: "opacity-0"
        -->
        <template x-for="(notification, index) in $store.notifications.items">
            <div class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-text-clr-100 shadow-lg ring-1 ring-black ring-opacity-5">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <x-icons.outline.check-circle x-show="notification.type === 'success'" class="text-green-400" />
                            <x-icons.outline.x-circle x-show="notification.type === 'error'" class="text-red-400" />
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm font-medium text-text-clr-900" x-text="notification.message"></p>
                            <p class="mt-1 text-sm text-text-clr-500" x-text="notification.description"></p>
                        </div>
                        <div class="ml-4 flex flex-shrink-0">
                            <button @click="$store.notifications.remove(index)" type="button" class="inline-flex rounded-md text-text-clr-400 hover:text-text-clr-500">
                                <span class="sr-only">Close</span>
                                <x-icons.mini.x-mark />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
@push('scripts')
    <script>
        const notifications = @json($notifications);
        if(notifications){
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
