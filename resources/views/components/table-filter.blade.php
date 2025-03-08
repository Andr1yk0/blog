@props([
    'label',
    'inputId',
    'inputName',
    'xModel',
])
<div {{$attributes}}>
    <label for="{{$inputId}}" class="block text-sm font-medium leading-6 text-gray-900">{{$label}}</label>
    <div class="mt-2">
        <input
            @input.debounce.600ms="$event.target.closest('form').submit()"
            x-model="{{$xModel}}"
            type="text"
            name="{{$inputName}}"
            id="{{$inputId}}"
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
        >
    </div>
</div>