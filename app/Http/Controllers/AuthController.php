<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Illuminate\Support\Facades\Hash;

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


    function handleLogin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Login gagal, periksa email dan password Anda'], 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(['token' => $token, 'message' => 'Login berhasil'], 200);
    }
}
