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
            ->assertSee('Contact me');
    }

    public function test_store_contact_info(): void
    {
        $data = [
            'name' => 'Tester',
            'email' => 'test@example.com',
            'message' => 'Hello',
            'captcha_score' => 0.6
        ];

        $captchaServiceMock = \Mockery::mock(CaptchaService::class, function (MockInterface $mock) use ($data) {
            $mock->shouldReceive('verifyRequest')->once()->andReturn(true);
            $mock->shouldReceive('getScore')->once()->andReturn($data['captcha_score']);
        });
        $this->instance(CaptchaService::class, $captchaServiceMock);

        $this->from('/contacts')->post('contacts', $data)->assertRedirect('contacts');

        $this->assertDatabaseHas('contact_requests', $data);
    }

    public function test_failed_robot_check(): void
    {
        $captchaServiceMock = \Mockery::mock(CaptchaService::class, function (MockInterface $mock) {
            $mock->shouldReceive('verifyRequest')->once()->andReturn(false);
        });
        $this->instance(CaptchaService::class, $captchaServiceMock);

        $res = $this->from('/contacts')->post('contacts', [
            'name' => 'Tester',
            'email' => 'test@example.com',
            'message' => 'Hello',
        ]);

        $res->assertRedirect('contacts');
        $res->assertSessionHasErrors();
        $this->assertDatabaseEmpty('contact_requests');
    }

    public function test_cookie_policy(): void
    {
        $this->get('cookie-policy')->assertSuccessful();
    }

    public function test_privacy_policy(): void
    {
        $this->get('privacy-policy')->assertSuccessful();
    }

    public function test_terms_and_conditions(): void
    {
        $this->get('terms-and-conditions')->assertSuccessful();
    }
}
