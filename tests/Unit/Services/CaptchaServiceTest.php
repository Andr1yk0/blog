<?php

use App\Services\CaptchaService;

test('verify request', function () {
    $captchaService = new CaptchaService();
    $requestData = [
        'g-recaptcha-response' => 'test'
    ];
    \Http::fake([
        'https://www.google.com/*' => \Http::sequence()
                    ->push(['score' => 0.6, 'success' => true])
                    ->push(['score' => 0.5, 'success' => true])
                    ->push(['score' => 0.5, 'success' => false])
    ]);

    expect($captchaService->verifyRequest($requestData))->toBeTrue();
    expect($captchaService->verifyRequest($requestData))->toBeFalse();

    \Log::shouldReceive('error')->once();
    expect($captchaService->verifyRequest($requestData))->toBeTrue();
});
