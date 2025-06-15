<?php

use App\Services\CaptchaService;
use Mockery\MockInterface;

uses(\Tests\RefreshDatabaseCustom::class);

test('contact page', function () {
    $response = $this->get('/contacts');

    $response->assertStatus(200)
        ->assertSee('Contact me');
});

test('store contact info', function () {
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
});

test('failed robot check', function () {
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
});

test('email verification', function () {
    $data = [
        'name' => 'Tester',
        'email' => 'testexample.com',
        'message' => 'Hello',
        'captcha_score' => 0.6
    ];

    $response = $this->followingRedirects()->from('/contacts')->post('contacts', $data);
    $response->assertSee('The email field must be a valid email address.');
});

test('cookie policy', function () {
    $this->get('cookie-policy')->assertSuccessful();
});

test('privacy policy', function () {
    $this->get('privacy-policy')->assertSuccessful();
});

test('terms and conditions', function () {
    $this->get('terms-and-conditions')->assertSuccessful();
});

test('show success message', function () {
    $response = $this->withSession(['success' => 'Success message!!'])->get('/contacts');
    $response->assertStatus(200)
        ->assertSee('Success message!!');
});

test('show failed message', function () {
    $response = $this->withViewErrors([
        'email' => ['Invalid email address!'],
    ])->get('/contacts');
    $response->assertStatus(200);
});