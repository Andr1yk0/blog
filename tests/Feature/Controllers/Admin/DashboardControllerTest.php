<?php

namespace Tests\Feature\Controllers\Admin;

use App\Services\GoogleAPIService;
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
        $this->markTestSkipped();
        $this->mock(GoogleAPIService::class, function ($mock) {
            $mock->shouldReceive('adSenseReport')->once();

        });

        $response = $this->setUser()->get('/admin');

        $response->assertStatus(200);
    }
}
