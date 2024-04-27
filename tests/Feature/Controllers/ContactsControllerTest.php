<?php

namespace Tests\Feature\Controllers;

use App\Services\CaptchaService;
use Mockery\MockInterface;
use Tests\RefreshDatabaseCustom;
use Tests\TestCase;

class ContactsControllerTest extends TestCase
{
    use RefreshDatabaseCustom;

    public function test_contact_page(): void
    {
        $response = $this->get('/contacts');

        $response->assertStatus(200)
            ->assertSee('Contact form');
    }

    public function test_store_contact_info(): void
    {
        $data = [
            'name' => 'Tester',
            'email' => 'test@example.com',
            'message' => 'Hello',
        ];

        $captchaServiceMock = \Mockery::mock(CaptchaService::class, function (MockInterface $mock) {
            $mock->shouldReceive('verifyRequest')->once()->andReturn(true);
        });
        $this->instance(CaptchaService::class, $captchaServiceMock);

        $this->post('contacts', $data)->assertRedirect('contacts');

        $this->assertDatabaseHas('contact_requests', [
            'name' => $data['name'],
            'email' => $data['email'],
            'message' => $data['message'],
        ]);
    }
}
