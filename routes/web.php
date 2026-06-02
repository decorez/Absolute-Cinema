<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\SnackController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudioController;
use App\Models\Movie;



Route::get('/', function () {
    $movies = Movie::latest()->take(8)->get();

    return view('home', compact('movies'));
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'admin'])->name('dashboard');

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
    Route::resource('studios', StudioController::class);
});

Route::middleware('auth')->group(function () {

    Route::resource('bookings', BookingController::class);

});

Route::get('/schedules/{schedule}/seats', [App\Http\Controllers\ScheduleController::class, 'seats'])->name('schedules.seats');

Route::get('/booking/{schedule}', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking/{schedule}', [BookingController::class, 'store'])->name('booking.store');

require __DIR__.'/auth.php';
