<?php

namespace Tests\Feature\Controllers;

use Tests\RefreshDatabaseCustom;
use Tests\TestCase;

class AboutControllerTest extends TestCase
{
    use RefreshDatabaseCustom;

    public function test_about_page(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
