<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\SettingController;

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

Route::view('/', 'welcome');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('dashboard', [DashboardController::class, 'createPost'])->name('dashboard.createPost');
Route::delete('dashboard/{photo}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');

Route::post('photos', [PhotoController::class, 'store'])
->middleware(['auth', 'verified'])
->name('photos.store');

Route::put('settings', [SettingController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('settings.update');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
