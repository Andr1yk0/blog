<div class="divide-y divide-text-clr-300 overflow-hidden rounded-lg bg-text-clr-50 shadow">
    @if(isset($header))
        <div class="px-4 py-5 sm:px-6 bg-clr-60">
            {{ $header }}
        </div>
    @endif

    <div class="px-4 py-5 sm:p-6">
        {{ $slot }}
    </div>

    @if(isset($footer))
        <div class="px-4 py-4 sm:px-6">
            {{ $footer }}
        </div>
    @endif
</div>
