<?php

namespace App\Services;

use App\Enums\OauthTokenTypeEnum;
use App\Models\OauthToken;
use Google\Client;
use Google\Service\Adsense;
use Google\Service\Adsense\ReportResult;
use Google\Service\Indexing;
use Google\Service\Indexing\PublishUrlNotificationResponse;
use Google\Service\Indexing\UrlNotification;
use Google\Service\SearchConsole;
use Google\Service\SearchConsole\InspectUrlIndexResponse;

class GoogleAPIService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->addScope([
            SearchConsole::WEBMASTERS,
            Adsense::ADSENSE_READONLY,
            Indexing::INDEXING,
        ]);
        $this->client->setAccessType('offline');
        $this->client->setPrompt('consent');
        $this->client->setAuthConfig(base_path('credentials.json'));

        $oauthToken = OauthToken::where('token_type', OauthTokenTypeEnum::GOOGLE_API->value)->first();
        if($oauthToken) {
            $this->client->setAccessToken($oauthToken->access_token);
            $this->client->refreshToken($oauthToken->refresh_token);
        }
    }

    public function getAuthUrl(): string
    {
        return $this->client->createAuthUrl();
    }

    public function isAccessTokenExpired(): bool
    {
        return $this->client->isAccessTokenExpired();
    }

    public function getAccessToken(string $code): array
    {
        return $this->client->fetchAccessTokenWithAuthCode($code);
    }

    public function adSenseReport(array $settings): ReportResult
    {
        $adsense = new AdSense($this->client);
        $propertyId = config('services.google-adsense.property-id');
        return $adsense->accounts_reports->generate(
            "accounts/$propertyId",
            $settings
        );
    }

    public function getPageIndexStatus(string $url): InspectUrlIndexResponse
    {
        $searchConsole = new SearchConsole($this->client);
        $inspectRequest = new SearchConsole\InspectUrlIndexRequest();
        $inspectRequest->setSiteUrl('sc-domain:prostocode.com');
        $inspectRequest->setInspectionUrl($url);
        return $searchConsole->urlInspection_index->inspect($inspectRequest);
    }

    public function indexNow(string $url): PublishUrlNotificationResponse
    {
        $indexing = new Indexing($this->client);
        $urlNotification = new UrlNotification();
        $urlNotification->setUrl($url);
        $urlNotification->setType('URL_UPDATED');
        return $indexing->urlNotifications->publish($urlNotification);
    }
}