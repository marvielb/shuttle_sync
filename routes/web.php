<?php

use App\Http\Controllers\BookingConfirmationController;
use App\Http\Controllers\BookingHistoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShuttleSearchController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/shuttles/search', [ShuttleSearchController::class, 'index'])->name('shuttles.search');
    Route::post('/shuttles/search', [ShuttleSearchController::class, 'search'])->name('shuttles.search.results');
    Route::get('/booking/{shuttleScheduleId}/confirmation', [BookingConfirmationController::class, 'create'])->name('booking.confirmation');
    Route::post('/booking/{shuttleScheduleId}/confirmation', [BookingConfirmationController::class, 'store'])->name('booking.confirmation.result');
    Route::get('/booking-history', [BookingHistoryController::class, 'index'])->name('booking.history');
    Route::get('/driver/dashboard', [DriverDashboardController::class, 'index'])->name('driver.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
