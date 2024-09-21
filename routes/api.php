<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JishoController;
use App\Http\Controllers\leaderboardController;
use App\Http\Controllers\ujianController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('auth/google', [AuthController::class, 'redirectToGoogle']);

Route::middleware('api.key')->group(function () {
    Route::post('auth/google', [AuthController::class, 'handleGoogleCallback']);
    Route::post('login', [AuthController::class, 'handleLogin']);


    Route::get('ujian', [ujianController::class, 'getUjianData']);
    Route::get('ujian/soal/{ujian_id}', [ujianController::class, 'getUjianSoalData']);
    Route::get('ujian-token/{token}', [ujianController::class, 'checkUjianToken']);
    Route::get('ujian-token/{ujian_id}/{user_id}', [ujianController::class, 'getUjianToken']);
    Route::post('ujian/submit', [ujianController::class, 'submitUjian']);
});

Route::get('/jisho', [JishoController::class, 'search']);
Route::get('/leaderboard', [leaderboardController::class, 'getData']);
