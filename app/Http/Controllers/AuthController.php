<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        // return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            // $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $request->email)->first();
        
            if (!$user) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt(date('YmdHis')),
                    'type_login' => 'google',
                    'image' => $request->image
                ]);
            }
        
            // Update the image field with the latest image URL from the request
            $user->image = $request->image;
            $user->save(); // Save the updated user information
        
            $token = JWTAuth::fromUser($user);
        
            return response()->json([
                'token' => $token,
                'user' => $user
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to authenticate'], 500);
        }
        
    }
}
