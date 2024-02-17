<?php

use App\Http\Controllers\GetContestsController;
use App\Http\Controllers\GetLateNumbersController;
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

Route::name('api.')->group(function () {
    Route::get('/contests', GetContestsController::class)->name('contests');
    Route::get('/late-numbers', GetLateNumbersController::class)->name('late-numbers');
});
