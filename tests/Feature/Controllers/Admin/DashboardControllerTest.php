<?php

namespace Tests\Feature\Controllers\Admin;

use App\Services\GoogleAPIService;
use Mockery;
use Tests\AuthUser;
use Tests\RefreshDatabaseCustom;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use AuthUser, RefreshDatabaseCustom;

    public function test_dashboard_is_not_public(): void
    {
        $response = $this->get('/admin');

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function test_logged_in_user_can_access_dashboard(): void
    {
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
    }
}
