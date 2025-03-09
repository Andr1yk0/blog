@if($paginator->hasPages())
    <div class="text-center bg-white shadow-sm p-4 rounded-lg dark:text-gray-100 dark:bg-gray-800">
        <!-- Visible on mobile -->
        <nav class="flex sm:hidden">
            @if(!$paginator->onFirstPage())
                <x-pagination-button href="{{$paginator->previousPageUrl()}}">
                    <x-icons.mini.chevron-left class="-mx-1.5"/>
                </x-pagination-button>
            @endif
            <div class="flex grow items-center justify-center px-2 sm:px-4">
                <span>Page <span class="font-semibold">{{$paginator->currentPage()}}</span> of
                <span class="font-semibold">{{$paginator->lastPage()}}</span></span>
            </div>
            @if($paginator->hasMorePages())
                <x-pagination-button href="{{$paginator->nextPageUrl()}}">
                    <x-icons.mini.chevron-right class="-mx-1.5" />
                </x-pagination-button>
            @endif
        </nav>
        <!-- END Visible on mobile -->
        <!-- Visible on desktop -->
        <nav class="hidden justify-between gap-1 sm:flex">
            @if(!$paginator->onFirstPage())
                <x-pagination-button href="{{$paginator->previousPageUrl()}}">
                    <x-icons.mini.chevron-left class="-mx-1.5"/>
                </x-pagination-button>
            @else
                <div></div>
            @endif
            <div class="inline-flex gap-1">
                @foreach($elements as $element)
                    @if(is_string($element))
                        <div class="flex items-center justify-center px-4 text-clr-700 dark:text-clr-300">
                            ...
                        </div>
                    @elseif(is_array($element))
                        @foreach($element as $page => $url)
                            @if($page == $paginator->currentPage())
                                <span
                                   class="inline-flex items-center justify-center gap-2 rounded-lg border border-transparent bg-clr-50 px-4 py-2 font-semibold leading-6 text-clr-800 focus:ring focus:ring-clr-300/25 dark:bg-clr-700 dark:text-clr-100 dark:focus:ring-clr-600/40">
                                    {{$page}}
                                </span>
                            @else
                                <x-pagination-button href="{{$url}}">{{$page}}</x-pagination-button>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>
            @if($paginator->hasMorePages())
                <x-pagination-button href="{{$paginator->nextPageUrl()}}">
                    <x-icons.mini.chevron-right class="-mx-1.5" />
                </x-pagination-button>
            @else
                <div></div>
            @endif
        </nav>
    </div>
@endif
