<?php

namespace App\View\Components;

use App\Services\GoogleAPIService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdSenseReport extends Component
{
    public array $headers = [];
    public array $rows = [];

    public function render(): View|Closure|string
    {
        $googleAPIService = app(GoogleAPIService::class);
        $reportResult = $googleAPIService->adSenseReport([
            'dateRange' => $settings['dateRange'] ?? 'today',
            'metrics' => ['ESTIMATED_EARNINGS', 'PAGE_VIEWS', 'PAGE_VIEWS_RPM'],
            'dimensions' => ['COUNTRY_NAME'],
        ]);
        $this->headers = $reportResult->getHeaders();
        $this->rows = $reportResult->getRows();
        return view('components.ad-sense-report');
    }
}
