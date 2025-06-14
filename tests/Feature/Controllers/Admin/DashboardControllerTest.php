<?php

use App\Services\GoogleAPIService;

uses(\Tests\AuthUser::class);
uses(\Tests\RefreshDatabaseCustom::class);

test('dashboard is not public', function () {
    $response = $this->get('/admin');

    $response->assertStatus(302);
    $response->assertRedirect('login');
});

test('logged in user can access dashboard', function () {
    $this->mock(GoogleAPIService::class, function ($mock) {
        $fakeResult = Mockery::mock(\Google_Service_Adsense_ReportResult::class);
        $fakeResult->shouldReceive('getHeaders')
            ->once()
            ->andReturn([(object) ['name' => 'COUNTRY_NAME']]);
        $fakeResult->shouldReceive('getRows')->once()->andReturn([]);

        $mock->shouldReceive('adSenseReport')->once()->andReturn($fakeResult);

    });

    $response = $this->setUser()->get('/admin');

    $response->assertStatus(200);
});