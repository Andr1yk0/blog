<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class CaptchaService
{
    protected ?float $score = null;

    /**
     * @throws GuzzleException
     */
    public function verifyRequest(array $requestData): bool
    {
        $this->score = null;
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
        $this->score = $captchaResponseObj->score;

        return $captchaResponseObj->score > 0.5;
    }

    public function getScore(): ?float
    {
        return $this->score;
    }
}
