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
use App\Http\Controllers\PromoController;

use App\Models\Movie;
use App\Models\Snack;
use App\Models\Promo;

Route::get('/', function () {
    $movies = Movie::latest()->take(4)->get();
    $snacks = Snack::latest()->take(4)->get();
    $promos = Promo::latest()->get();

    return view('home', compact('movies', 'snacks', 'promos'));
});

Route::get('/all-movies', function () {
    $movies = Movie::latest()->get();
    return view('movies.all', compact('movies'));
})->name('movies.all');

Route::get('/all-promos', [PromoController::class, 'index'])->name('promos.all');

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

    Route::post('/promos/{id}/claim', [PromoController::class, 'claim'])->name('promos.claim');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/snacks', [SnackController::class, 'adminIndex'])->name('snacks.admin');
    Route::get('/snacks/create', [SnackController::class, 'create'])->name('snacks.create');
    Route::post('/snacks', [SnackController::class, 'store'])->name('snacks.store');
    Route::get('/snacks/{snack}/edit', [SnackController::class, 'edit'])->name('snacks.edit');
    Route::put('/snacks/{snack}', [SnackController::class, 'update'])->name('snacks.update');
    Route::delete('/snacks/{snack}', [SnackController::class, 'destroy'])->name('snacks.destroy');

    Route::get('/admin/promos', [PromoController::class, 'adminIndex'])->name('promos.index');
    Route::get('/admin/promos/create', [PromoController::class, 'create'])->name('promos.create');
    Route::post('/admin/promos', [PromoController::class, 'store'])->name('promos.store');
    Route::get('/admin/promos/{promo}/edit', [PromoController::class, 'edit'])->name('promos.edit');
    Route::put('/admin/promos/{promo}', [PromoController::class, 'update'])->name('promos.update');
    Route::delete('/admin/promos/{promo}', [PromoController::class, 'destroy'])->name('promos.destroy');

    Route::get('/admin/bookings', [BookingController::class, 'adminIndex'])->name('admin.bookings');
    Route::post('/admin/bookings/{booking}/approve', [BookingController::class, 'approve'])->name('admin.bookings.approve');
    Route::delete('/admin/bookings/{booking}/force-delete', [BookingController::class, 'forceDelete'])->name('admin.bookings.forceDelete');
    
    Route::resource('movies', MovieController::class)->except(['show']);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('seats', SeatController::class);
    Route::resource('studios', StudioController::class);
});

Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

Route::get('/snacks-lounge', [SnackController::class, 'index'])->name('snacks.all');

Route::get('/schedules/{schedule}/seats', [App\Http\Controllers\ScheduleController::class, 'seats'])->name('schedules.seats');

Route::delete('/studios/{studio}/seats', [SeatController::class, 'destroyByStudio'])->name('seats.destroyByStudio');

Route::get('/pay-booking/{code}', [BookingController::class, 'scanPayment'])
    ->name('booking.scanPayment');

Route::get('/bookings/{booking}/payment-qr', [BookingController::class, 'showPaymentQr'])
    ->name('bookings.qr');
    
Route::post('/checkout/snacks', [BookingController::class, 'snackCheckout'])
    ->middleware('auth')
    ->name('snacks.checkout');

require __DIR__.'/auth.php';
