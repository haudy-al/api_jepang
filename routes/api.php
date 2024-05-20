<?php

use App\Http\Controllers\AuthController;
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
Route::post('auth/google', [AuthController::class, 'handleGoogleCallback']);


Route::get('ujian', [ujianController::class, 'index']);
Route::get('ujian-token/{ujian_id}/{user_id}', [ujianController::class, 'getUjianToken']);



