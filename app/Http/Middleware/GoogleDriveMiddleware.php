<?php

namespace App\Http\Middleware;

use Closure;
use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDrive;

class GoogleDriveMiddleware
{
    public function handle($request, Closure $next)
    {
        $client = new GoogleClient();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URL'));
        $client->addScope(GoogleDrive::DRIVE);

        if (!$request->session()->has('google_drive_token')) {
            $authUrl = $client->createAuthUrl();
            return redirect($authUrl);
        }

        $client->setAccessToken($request->session()->get('google_drive_token'));

        if ($client->isAccessTokenExpired()) {
            $refreshToken = $client->getRefreshToken();
            $client->fetchAccessTokenWithRefreshToken($refreshToken);
            $request->session()->put('google_drive_token', $client->getAccessToken());
        }

        return $next($request);
    }
}
