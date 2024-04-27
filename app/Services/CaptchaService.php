<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class CaptchaService
{
    /**
     * @throws GuzzleException
     */
    public function verifyRequest(array $requestData): bool
    {
        $client = app(Client::class);
        $captchaResponse = $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'response' => $requestData['g-recaptcha-response'],
                'secret' => config('captcha.secret_key'),
            ],
        ]);

        $captchaResponseObj = json_decode($captchaResponse->getBody()->getContents());

        if (! $captchaResponseObj->success) {
            Log::error('Captcha error', ['response' => $captchaResponseObj]);

            return true;
        }

        return $captchaResponseObj->score > 0.5;
    }
}
