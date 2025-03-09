@props(['href'])
<a href="{{$href}}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-transparent bg-white px-4 py-2 font-semibold leading-6 text-clr-700 hover:bg-clr-50 hover:text-clr-800 focus:ring focus:ring-clr-300/25 active:bg-transparent dark:bg-transparent dark:text-clr-300 dark:hover:bg-clr-700 dark:hover:text-clr-100 dark:focus:ring-clr-600/40 dark:active:bg-transparent">
    {{$slot}}
</a>