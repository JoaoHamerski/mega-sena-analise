<?php

use App\Http\Controllers\MegaSenaDataController;
use App\Http\Controllers\MegaSenaUploadShowController;
use App\Http\Controllers\MegaSenaUploadStoreController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
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

Route::get('/', MegaSenaDataController::class)->name('home');

Route::get('/upload', MegaSenaUploadShowController::class)->name('upload.show');
Route::post('/upload', MegaSenaUploadStoreController::class)->name('upload.store');
