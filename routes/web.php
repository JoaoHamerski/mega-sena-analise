<?php

use App\Http\Controllers\MegaSenaHomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MegaSenaStatsLateNumbersController;
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
})->name('home');

Route::get('/stats/late-numbers', MegaSenaStatsLateNumbersController::class)->name('stats.late-numbers');
