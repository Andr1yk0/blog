<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class CaptchaService
{
    protected ?float $score = null;

    public function verifyRequest(array $requestData): bool
    {
        $this->score = null;
        $captchaResponse = \Http::post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'response' => $requestData['g-recaptcha-response'],
                'secret' => config('captcha.secret_key'),
            ],
        ]);

        $requestData = $captchaResponse->json();
        if (! data_get($requestData, 'success')) {
            Log::error('Captcha error', ['response' => $requestData]);
            return true;
        }
        $this->score = $requestData['score'];
        return $requestData['score'] > 0.5;
    }

    public function getScore(): ?float
    {
        return $this->score;
    }
}
