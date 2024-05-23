<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ujianController;
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



Route::get('/', [DashboardController::class,'index']);
Route::get('/ujian', [ujianController::class,'ujianPage']);
Route::get('/ujian/{id}', [ujianController::class,'DetailUjianPage']);
