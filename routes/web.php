<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\SnackController;
use App\Http\Controllers\BookingController;


Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('movies', MovieController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('seats', SeatController::class);
    Route::resource('snacks', SnackController::class);
});

Route::middleware('auth')->group(function () {

    Route::resource('bookings', BookingController::class);

});

require __DIR__.'/auth.php';
