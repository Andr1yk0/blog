@extends('layouts.app')
@section('content')
    @php
        $heatMapData = \App\Models\Config::where('key', \App\Enums\ConfigKeyEnum::EXPERIENCE_HEATMAP)->first()->value;
        $heatMapYears = array_keys($heatMapData[0]['history']);
        $heatMapCellBackgrounds = [
            'bg-gray-100', 'bg-indigo-100', 'bg-indigo-200', 'bg-indigo-300', 'bg-indigo-400', 'bg-indigo-500',
            'bg-indigo-600', 'bg-indigo-700', 'bg-indigo-800', 'bg-indigo-900'
        ];
    @endphp
    <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
        <div class="grid grid-cols-1 items-start gap-x-8 gap-y-8 lg:grid-cols-2">
            <x-card>
                <x-slot:header>
                    <h3 class="text-base font-semibold leading-6 text-gray-900">About the website</h3>
                    </x-slot>
                    <div class="flex flex-wrap gap-2">
                        I'm a full-stack web developer from Lviv, Ukraine.
                        I have {{ \Carbon\Carbon::now()->diffInYears(\Carbon\Carbon::create(2016, 1, 1)) }}+ years of experience in building web applications with PHP and JavaScript.
                    </div>
            </x-card>
            <x-card>
                <x-slot:header>
                    <h3 class="text-base font-semibold leading-6 text-gray-900">About the author</h3>
                    </x-slot>
                    <div class="flex flex-wrap gap-2">
                        I'm a full-stack web developer from Lviv, Ukraine.
                        I have {{ \Carbon\Carbon::now()->diffInYears(\Carbon\Carbon::create(2016, 1, 1)) }}+ years of experience in building web applications with PHP and JavaScript.
                    </div>
            </x-card>
            <div class="lg:col-span-2">
                <x-card>
                    <x-slot:header>
                        <h3 class="text-base font-semibold leading-6 text-gray-900">Experience heatmap</h3>
                        </x-slot>
                        <div>
                            <div class="flex">
                                <div class="w-28 mt-5 border-r flex-shrink-0">
                                    @foreach($heatMapData as $item)
                                        <div class="h-10">
                                            <span class="text-sm">{{ $item['title'] }}</span>
                                            <p class="text-xs text-gray-500"> {{$item['duration']}} </p>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="overflow-auto">
                                    <div class="flex">
                                        @foreach($heatMapData[0]['history'] as $year => $data)
                                            <div class="w-[10rem] flex-shrink-0 text-center">{{ $year }}</div>
                                        @endforeach
                                    </div>
                                    @foreach($heatMapData as $item)
                                        <div class="flex">
                                            @foreach($item['history'] as $year => $historyData)
                                                @foreach($historyData as $historyValue)
                                                    <div class="p-0.5 w-10 h-10 flex-shrink-0">
                                                        <div
                                                            class="w-full h-full rounded-sm {{ $heatMapCellBackgrounds[$historyValue] }}"></div>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="flex justify-center">
                                    <div class="text-xs text-gray-500 my-auto px-1 text-center">No usage</div>
                                    @foreach($heatMapCellBackgrounds as $background)
                                        <div class="p-0.5 w-8 h-8 flex-shrink-0">
                                            <div class="w-full h-full rounded-sm {{ $background }}"></div>
                                        </div>
                                    @endforeach
                                    <div class="text-xs text-gray-500 my-auto px-1 text-center">High usage</div>
                                </div>
                            </div>
                        </div>
                </x-card>
            </div>
        </div>
    </div>
@endsection
