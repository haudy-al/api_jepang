<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ujianController;
use App\Livewire\HasilUjian;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('google/callback', [GoogleController::class, 'callback']);


Route::get('/', [DashboardController::class, 'index']);


// Route::group(['middleware' => 'google.drive'], function () {
Route::get('/ujian', [ujianController::class, 'ujianPage']);
Route::get('/ujian/{id}', [ujianController::class, 'DetailUjianPage']);
Route::get('/ujian/{id}/hasil', HasilUjian::class);

// });
