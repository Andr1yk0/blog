<?php

namespace App\Console\Commands;

use App\Enums\ConfigKeyEnum;
use App\Models\Config;
use Faker\Core\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class UpdateExperienceHeatmap extends Command
{
    protected $signature = 'app:update-experience-heatmap';

    protected $description = 'Command description';

    public function handle()
    {
        $filePath = Storage::path('experience_graph.csv');
        $file = fopen($filePath, 'r');
        if(!$file) {
            $this->error('File not found!');
            return;
        }
        $languages = fgetcsv($file);
        array_shift($languages);

        $months = fgetcsv($file);
        array_shift($months);

        $heatMapData = [];
        foreach ($languages as $index => $language){
            $yearsCount = round($months[$index] / 12);
            $monthsCount = $months[$index] % 12;
            $duration = '';
            if ($yearsCount > 0) {
                $duration .= $yearsCount . ' year';
                if ($yearsCount > 1) {
                    $duration .= 's';
                }
            }
            if ($monthsCount > 0) {
                if ($yearsCount > 0) {
                    $duration .= ' ';
                }
                $duration .= $monthsCount . ' month';
                if ($monthsCount > 1) {
                    $duration .= 's';
                }
            }
            $heatMapData[] = [
                'title' => $language,
                'months' => (int) $months[$index],
                'duration' => $duration,
                'history' => [],
            ];
        }

        while ($row = fgetcsv($file)) {
            $date = array_shift($row);
            $monthYear = explode('/', $date);
            $year = (int) $monthYear[1];
            $month = (int) $monthYear[0];

            foreach ($row as $index => $value) {
                if(!isset($heatMapData[$index]['history'][$year])) {
                    $heatMapData[$index]['history'][$year] = [0,0,0,0];
                }

                if($month <= 3) {
                    $heatMapData[$index]['history'][$year][3] += (int)$value;
                }elseif ($month <= 6) {
                    $heatMapData[$index]['history'][$year][2] += (int)$value;
                }elseif ($month <= 9) {
                    $heatMapData[$index]['history'][$year][1] += (int)$value;
                }elseif ($month <= 12) {
                    $heatMapData[$index]['history'][$year][0] += (int)$value;
                }
            }
        }
        fclose($file);

        usort($heatMapData, function($a, $b) {
            return $b['months'] <=> $a['months'];
        });

        foreach ($heatMapData as $index => $data) {
            $heatMapData[$index]['history'] = array_reverse($data['history'], true);
        }

        $config = Config::where('key', ConfigKeyEnum::EXPERIENCE_HEATMAP)->first();
        $config->value = $heatMapData;
        $config->save();
    }
}
