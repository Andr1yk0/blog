@if($paginator->hasPages())
    <div class="flex items-center justify-between border-t border-text-clr-200 px-4 py-3 sm:px-6">
        <div class="flex flex-1 justify-between sm:hidden">
            @if($paginator->onFirstPage())
                <span
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-text-clr-500 border border-text-clr-300 cursor-default leading-5 rounded-md">Previous</span>
            @else
                <a href="{{$paginator->previousPageUrl()}}"
                   class="relative inline-flex items-center rounded-md border border-text-clr-300 px-4 py-2 text-sm font-medium text-text-clr-700 hover:bg-text-clr-100">Previous</a>
            @endif
            @if($paginator->hasMorePages())
                <a href="{{$paginator->nextPageUrl()}}"
                   class="relative inline-flex items-center rounded-md border border-text-clr-300 px-4 py-2 text-sm font-medium text-text-clr-700 hover:bg-text-clr-100">Next</a>
            @else
                <span
                    class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-text-clr-500 border border-text-clr-300 cursor-default leading-5 rounded-md">Next</span>
            @endif
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-text-clr-600">
                    Showing
                    @if($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        to
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    of
                    <span class="font-medium">{{$paginator->total()}}</span>
                    results
                </p>
            </div>
            <div>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    @if($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="Previous">
                            <span
                                class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-text-clr-500 border border-text-clr-300 cursor-default rounded-l-md leading-5"
                                aria-hidden="true">
                                <x-icons.mini.chevron-left />
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}"
                           class="relative inline-flex items-center rounded-l-md px-2 py-2 text-text-clr-400 ring-1 ring-inset ring-text-clr-300 hover:bg-text-clr-100 focus:z-20 focus:outline-offset-0">
                            <span class="sr-only">Previous</span>
                            <x-icons.mini.chevron-left />
                        </a>
                    @endif
                    @foreach($elements as $element)
                        @if(is_string($element))
                            <span
                                class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-text-clr-700 ring-1 ring-inset ring-text-clr-300 focus:outline-offset-0">...</span>
                        @endif
                        @if(is_array($element))
                            @foreach($element as $page => $url)
                                @if($page == $paginator->currentPage())
                                    <span aria-current="page"
                                          class="relative z-10 inline-flex items-center bg-clr-200 px-4 py-2 text-clr-700 text-sm font-semibold focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-clr-600">{{$page}}</span>
                                @else
                                    <a href="{{$url}}"
                                       class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-text-clr-700 ring-1 ring-inset ring-text-clr-300 hover:bg-text-clr-100 focus:z-20 focus:outline-offset-0">{{$page}}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    @if($paginator->hasMorePages())
                        <a href="{{$paginator->nextPageUrl()}}"
                           class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-text-clr-300 hover:bg-text-clr-100 focus:z-20 focus:outline-offset-0">
                            <span class="sr-only">Next</span>
                            <x-icons.mini.chevron-right />
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="Next">
                            <span
                                class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-text-clr-500 border border-text-clr-300 cursor-default rounded-r-md leading-5"
                                aria-hidden="true">
                                <x-icons.mini.chevron-right />
                            </span>
                        </span>
                    @endif
                </nav>
            </div>
        </div>
    </div>
@endif
