<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OauthTokenTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\OauthToken;
use App\Services\GoogleAPIService;

class GoogleAuthController extends Controller
{
    public function callback(GoogleAPIService $googleAPIService)
    {
        $tokenData = $googleAPIService->getAccessToken(request('code'));

        if(!isset($tokenData['access_token'])) {
            throw new \Exception('Google API Authorization Error');
        }

        OauthToken::updateOrCreate(
            [
                'token_type' => OauthTokenTypeEnum::GOOGLE_API->value,
            ],
            [
                'token_type' => OauthTokenTypeEnum::GOOGLE_API->value,
                'access_token' => $tokenData['access_token'],
                'refresh_token' => $tokenData['refresh_token'],
            ]
        );
        return redirect()->route('admin.dashboard');
    }
}
