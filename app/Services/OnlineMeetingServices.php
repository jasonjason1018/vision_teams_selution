<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class OnlineMeetingServices
{
    public function getToken()
    {
        $uri = "https://login.microsoftonline.com/" . env('MS_SECRET_KEY') . "/oauth2/v2.0/token";

        $param = [
            "client_id" => env('MS_CLIENT_ID'),
            "scope" => "https://graph.microsoft.com/.default",
            "client_secret" => env('MS_CLIENT_SECRET'),
            "username" => 'jason_chang@everrich.com.tw',
            "password" => 'Ever@2024',
            "grant_type" => "password",
        ];

        $response = Http::asForm()->post($uri, $param);
        $token = $response->json()['access_token'];

        return $token;
    }

    public function createMeeting($token)
    {
        $uri = "https://graph.microsoft.com/v1.0/me/onlineMeetings";
        $param = [
            "startDateTime" => Carbon::now(),
            "endDateTime" => null,
            "subject" => "User Token Meeting",
            "joinMeetingIdSettings" => [
                'isPasscodeRequired' => false
            ]
        ];

        $response = Http::withToken($token, 'Bearer')->asJson()->post($uri, $param);

        return $response->json();
    }
}
