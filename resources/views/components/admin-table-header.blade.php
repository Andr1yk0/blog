<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
    @if(!$sortBy)
        {{$title}}
    @else
        <a href="{{$url}}" class="group inline-flex">
            {{$title}}
            <span class="ml-2 flex-none rounded @if($isSorted())bg-gray-200 text-gray-900 group-hover:bg-gray-200 @else invisible text-gray-400 group-hover:visible group-focus:visible @endif">
                @if($sortDirection === 'asc')
                    <x-icons.mini.chevron-up />
                @else
                    <x-icons.mini.chevron-down />
                @endif
            </span>
        </a>
    @endif
</th>
