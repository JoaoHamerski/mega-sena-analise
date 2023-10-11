<?php

use App\Http\Controllers\MegaSenaHomeController;
use App\Http\Controllers\MegaSenaHomeStatsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('home.')->group(function () {
    Route::get('/', MegaSenaHomeController::class)->name('index');
    Route::get('/stats', MegaSenaHomeStatsController::class)->name('stats');
})->name('home');
