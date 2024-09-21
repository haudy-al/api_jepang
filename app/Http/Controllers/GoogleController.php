<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client as GoogleClient;

class GoogleController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new GoogleClient();
        $this->client->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $this->client->setRedirectUri(env('GOOGLE_REDIRECT_URL'));
    }

    public function callback(Request $request)
    {
        $this->client->authenticate($request->code);
        session()->put('google_drive_token', $this->client->getAccessToken());
        return redirect('/ujian');
    }
}
