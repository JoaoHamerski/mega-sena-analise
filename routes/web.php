<?php

use App\Http\Controllers\MegaSenaHomeController;
use App\Http\Controllers\MegaSenaCreateController;
use App\Http\Controllers\MegaSenaStoreController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', MegaSenaHomeController::class)->name('home');

Route::get('/upload', MegaSenaCreateController::class)->name('upload.show');
Route::post('/upload', MegaSenaStoreController::class)->name('upload.store');
