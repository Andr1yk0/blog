<?php

namespace Tests\Unit\Services;

use App\Services\CaptchaService;
use Tests\TestCase;

class CaptchaServiceTest extends TestCase
{

    public function test_verify_request(): void
    {
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

        $this->assertTrue($captchaService->verifyRequest($requestData));
        $this->assertFalse($captchaService->verifyRequest($requestData));

        \Log::shouldReceive('error')->once();
        $this->assertTrue($captchaService->verifyRequest($requestData));

    }
}
