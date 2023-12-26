<?php

use App\Http\Controllers\ProfileController;
use App\Models\Location;
use App\Models\TimeSlot;
use Carbon\Carbon;
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

Route::get('/dashboard', function () {
    $locations = Location::all();
    $timeSlots = TimeSlot::all()->map(function ($timeSlot) {
        return [
            'timeslot_id' => $timeSlot['timeslot_id'],
            'start_time' => Carbon::parse($timeSlot['start_time'])->format('h:i A'),
        ];
    });
    return view('dashboard', compact('locations', 'timeSlots'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
