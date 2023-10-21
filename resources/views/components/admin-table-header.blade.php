<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
    @if(!$sortBy)
        {{$title}}
    @else
        <a href="{{$url}}" class="group inline-flex">
            {{$title}}
            <span class="ml-2 flex-none rounded @if($isSorted())bg-gray-200 text-gray-900 group-hover:bg-gray-200 @else invisible text-gray-400 group-hover:visible group-focus:visible @endif">
                @if($sortDirection === 'asc')
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M14.77 12.79a.75.75 0 01-1.06-.02L10 8.832 6.29 12.77a.75.75 0 11-1.08-1.04l4.25-4.5a.75.75 0 011.08 0l4.25 4.5a.75.75 0 01-.02 1.06z" clip-rule="evenodd" />
                    </svg>
                @else
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                            clip-rule="evenodd"/>
                    </svg>
                @endif
            </span>
        </a>
    @endif
</th>
