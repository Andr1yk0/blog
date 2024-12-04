@if($heatMapData)
    <div class="lg:col-span-2">
        <x-card>
            <div>
                <div class="flex">
                    <div class="w-28 mt-7 border-r border-text-clr-300 flex-shrink-0">
                        @foreach($heatMapData as $item)
                            <div class="h-10">
                                <span class="text-sm text-gray-800-800">{{ $item['title'] }}</span>
                                <p class="text-xs text-gray-600"> {{$item['duration']}} </p>
                            </div>
                        @endforeach
                    </div>
                    <div class="overflow-auto">
                        <div class="flex">
                            @foreach($heatMapData[0]['history'] as $year => $data)
                                <div
                                    class="w-[10rem] text-text-clr-800 py-1 flex-shrink-0 text-center">{{ $year }}</div>
                            @endforeach
                        </div>
                        @foreach($heatMapData as $item)
                            <div class="flex">
                                @foreach($item['history'] as $year => $historyData)
                                    @foreach($historyData as $periodIndex => $historyValue)
                                        <div
                                            x-tooltip="{{$tooltipText($historyValue, $item['title'], $year, $periodIndex)}}"
                                            data-tooltip-position="{{$tooltipPosition($year)}}"
                                            class="p-0.5 w-10 h-10 flex-shrink-0 relative cursor-pointer"
                                        >
                                            <div
                                                class="w-full h-full rounded-sm {{ $heatMapCellBackgrounds[$historyValue] }}"
                                            ></div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex justify-center">
                        <div class="text-xs text-text-clr-600 my-auto px-1 text-center">Low usage</div>
                        @foreach($heatMapCellBackgrounds as $background)
                            @if($loop->first)
                                @continue
                            @endif
                            <div class="p-0.5 w-6 h-6 sm:w-7 sm:h-7 flex-shrink-0">
                                <div class="w-full h-full rounded-sm {{ $background }}"></div>
                            </div>
                        @endforeach
                        <div class="text-xs text-text-clr-600 my-auto px-1 text-center">High usage</div>
                    </div>
                </div>
            </div>
        </x-card>
    </div>
    @push('scripts')
        <script src="{{asset('js/directives/tooltip.js')}}"></script>
    @endpush
@endif

