<?php

namespace App\View\Components;

use App\Enums\ConfigKeyEnum;
use App\Models\Config;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ExperienceHeatmap extends Component
{
    public array $heatMapCellBackgrounds = [
        'bg-text-clr-100', 'bg-clr-100', 'bg-clr-200', 'bg-clr-300', 'bg-clr-400', 'bg-clr-500',
        'bg-clr-600', 'bg-clr-700', 'bg-clr-800', 'bg-clr-900'
    ];

    public array $heatMapData = [];
    public array $heatMapYears = [];
    public int $minYear;
    public int $maxYear;

    public function __construct()
    {
        $heatMapDataConfig = Config::where('key', ConfigKeyEnum::EXPERIENCE_HEATMAP)->first();
        $this->heatMapData = $heatMapDataConfig->value ?? [];
        $this->heatMapYears = $this->heatMapData ? array_keys($this->heatMapData[0]['history']) : [];
        $this->minYear = $this->heatMapYears ? min($this->heatMapYears) : 0;
        $this->maxYear = $this->heatMapYears ? max($this->heatMapYears) : 0;
    }

    public function render(): View|Closure|string
    {
        return view('components.experience-heatmap');
    }

    public function tooltipText(int $usage, string $tech, int $year, int $periodIndex): string
    {
        $usageText = match ($usage) {
            0 => 'No',
            1,2,3 => 'Low',
            4,5,6 => 'Average',
            7,8,9 => 'High',
        };
        $period = match ($periodIndex) {
            3 => 'from January to March',
            2 => 'from April to June',
            1 => 'from July to September',
            0 => 'from October to December',
        };
        return "$usageText usage of $tech $period $year";
    }

    public function tooltipPosition(int $year): string
    {
        if($year === $this->minYear){
            return 'left';
        }elseif ($year === $this->maxYear) {
            return 'right';
        }else{
            return 'top';
        }
    }
}
