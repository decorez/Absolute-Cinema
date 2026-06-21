<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Schedule;
use App\Models\Snack;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $bookingChart = Booking::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

        $bookingData = array_fill(0, 12, 0);

        foreach ($bookingChart as $item) {
            $bookingData[$item->month - 1] = $item->total;
        }

        $revenueLabels = [];
        $revenueData = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = now()->subDays($i);

            $revenueLabels[] = $date->format('d M');

            $revenueData[] = (float) Booking::where('status', 'paid')
                ->whereDate('created_at', $date)
                ->sum('total_price');
        }

        return view('dashboard', [
            'totalMovies' => Movie::count(),
            'totalSchedules' => Schedule::count(),
            'totalSnacks' => Snack::count(),
            'totalBookings' => Booking::count(),

            'totalrevenue' => Booking::where('status', 'paid')
                ->sum('total_price'),

            'pendingApproval' => Booking::where('status', 'pending')
                ->count(),

            'recentBookings' => Booking::with('user')
                ->latest()
                ->take(5)
                ->get(),

            'months' => $months,
            'bookingData' => $bookingData,
            'revenueLabels' => $revenueLabels,
            'revenueData' => $revenueData,
        ]);
    }
}