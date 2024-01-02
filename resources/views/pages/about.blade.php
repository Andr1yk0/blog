@extends('layouts.app')
@section('content')
    @php
        $heatMapDataConfig = \App\Models\Config::where('key', \App\Enums\ConfigKeyEnum::EXPERIENCE_HEATMAP)->first();
        $heatMapData = $heatMapDataConfig->value ?? [];
        $heatMapYears = $heatMapDataConfig ? array_keys($heatMapData[0]['history']) : [];
        $heatMapCellBackgrounds = [
            'bg-text-clr-100', 'bg-clr-100', 'bg-clr-200', 'bg-clr-300', 'bg-clr-400', 'bg-clr-500',
            'bg-clr-600', 'bg-clr-700', 'bg-clr-800', 'bg-clr-900'
        ];
    @endphp
    <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
        <div class="grid grid-cols-1 items-start gap-x-8 gap-y-8 lg:grid-cols-2">
            <x-card>
                <x-slot:header>
                    <h1 class="text-base font-semibold leading-6 text-text-clr-800">About prostocode.com</h1>
                    </x-slot>
                    <div class="prose prose-base text-text-clr-600 lg:prose-lg">
                        prostocode.com - a personal blog about web development technologies.
                        I write short posts about problems and solutions that I encounter in my work.
                        Writing helps me to structure my knowledge, share it with others and gives me motivation to explore new things.
                    </div>
            </x-card>
            <x-card>
                <x-slot:header>
                    <h2 class="text-base font-semibold leading-6 text-text-clr-800">About the author</h2>
                    </x-slot>
                    <div class="prose prose-base text-text-clr-600 lg:prose-lg">
                        I'm a full-stack web developer from Lviv, Ukraine.
                        I have {{ \Carbon\Carbon::now()->diffInYears(\Carbon\Carbon::create(2016, 1, 1)) }}+ years of experience in building web applications with PHP and JavaScript.
                    </div>
            </x-card>
            @if($heatMapDataConfig)
                <div class="lg:col-span-2">
                <x-card>
                    <x-slot:header>
                        <h3 class="text-base font-semibold leading-6 text-text-clr-800">Experience heatmap</h3>
                        </x-slot>
                        <div>
                            <div class="flex">
                                <div class="w-28 mt-5 border-r border-text-clr-300 flex-shrink-0">
                                    @foreach($heatMapData as $item)
                                        <div class="h-10">
                                            <span class="text-sm text-text-clr-800">{{ $item['title'] }}</span>
                                            <p class="text-xs text-text-clr-600"> {{$item['duration']}} </p>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="overflow-auto">
                                    <div class="flex">
                                        @foreach($heatMapData[0]['history'] as $year => $data)
                                            <div class="w-[10rem] text-text-clr-800 flex-shrink-0 text-center">{{ $year }}</div>
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
            @endif
        </div>
    </div>
@endsection
