<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MegaSenaController;
use App\Http\Controllers\StatsLateNumbersController;
use App\Http\Controllers\StatsOddEvenOccurrencesController;
use App\Http\Controllers\StatsOddEvenResultsController;

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
    Route::get('/', MegaSenaController::class)->name('index');
})->name('home');

Route::name('stats.')->prefix('stats')->group(function () {
    Route::get('late-numbers', StatsLateNumbersController::class)->name('late-numbers');
    Route::get('odd-even-occurrences', StatsOddEvenOccurrencesController::class)->name('odd-even-occurrences');
    Route::get('odd-even-results', StatsOddEvenResultsController::class)->name('odd-even-results');
});
