<div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-900 px-6 pb-4">
    <div class="flex h-16 shrink-0 items-center">
        <img class="h-8 w-auto" src="{{asset('logo.webp')}}" alt="Prostocode">
    </div>
    <nav class="flex flex-1 flex-col">
        <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
                <ul role="list" class="-mx-2 space-y-1">
                    @foreach($menuItems as $menuItem)
                        <li>
                            <a href="{{$menuItem['url']}}"
                               @class([
                                    'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                    'text-gray-400 hover:text-white hover:bg-gray-800' => !$menuItem['is_active'],
                                    'bg-gray-800 text-white' => $menuItem['is_active'],
                               ])
                            >
                                {{ $menuItem['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li class="mt-auto">
                <a href="{{route('admin.settings.index')}}" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-400 hover:bg-gray-800 hover:text-white">
                    <x-icons.outline.cog-6-tooth />
                    Settings
                </a>
            </li>
        </ul>
    </nav>
</div>
