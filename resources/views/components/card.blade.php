<div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
    @if(isset($header))
        <div class="px-4 py-5 sm:px-6">
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
