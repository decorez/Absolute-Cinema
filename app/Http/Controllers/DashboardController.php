<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Schedule;
use App\Models\Snack;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalMovies' => Movie::count(),
            'totalSchedules' => Schedule::count(),
            'totalSnacks' => Snack::count(),
            'totalBookings' => Booking::count(),
            'recentBookings' => Booking::with('user')->latest()->take(5)->get(),
            'totalrevenue' => Booking::where('status', 'paid')->sum('total_price'),
            'pendingApproval' => Booking::where('status', 'pending')->count(),
        ]);
        
    }
}
