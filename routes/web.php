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

    Route::get('/my-bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{schedule}/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings/{schedule}', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    Route::post('/bookings/{booking}/pay', [BookingController::class, 'pay'])->name('bookings.pay');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/bookings', [BookingController::class, 'adminIndex'])->name('admin.bookings');
    Route::post('/admin/bookings/{booking}/approve', [BookingController::class, 'approve'])->name('admin.bookings.approve');
    Route::delete('/admin/bookings/{booking}/force-delete', [BookingController::class, 'forceDelete'])->name('admin.bookings.forceDelete');
    
    Route::resource('movies', MovieController::class)->except(['show']);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('seats', SeatController::class);
    Route::resource('snacks', SnackController::class);
    Route::resource('studios', StudioController::class);
});

Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

Route::get('/schedules/{schedule}/seats', [App\Http\Controllers\ScheduleController::class, 'seats'])->name('schedules.seats');

Route::delete('/studios/{studio}/seats', [SeatController::class, 'destroyByStudio'])->name('seats.destroyByStudio');

Route::get('/pay-booking/{code}', [BookingController::class, 'scanPayment'])
    ->name('booking.scanPayment');

Route::get('/bookings/{booking}/payment-qr', [BookingController::class, 'showPaymentQr'])
    ->name('bookings.qr');
require __DIR__.'/auth.php';
