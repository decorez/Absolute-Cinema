@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')


<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    <div class="bg-white/5 border border-white/10 p-6 rounded-2xl hover:bg-white/10 transition">
        <p class="text-[10px] font-black text-[#D2C1B6] uppercase tracking-widest">
            Total Bookings
        </p>

        <h3 class="text-3xl font-black mt-2">
            {{ $totalBookings }}
        </h3>
    </div>

    <div class="bg-white/5 border border-white/10 p-6 rounded-2xl hover:bg-white/10 transition">
        <p class="text-[10px] font-black text-[#D2C1B6] uppercase tracking-widest">
            Total Revenue
        </p>

        <h3 class="text-3xl font-black mt-2">
            Rp {{ number_format($totalrevenue) }}
        </h3>
    </div>

    <div class="bg-white/5 border border-white/10 p-6 rounded-2xl hover:bg-white/10 transition">
        <p class="text-[10px] font-black text-amber-400 uppercase tracking-widest">
            Pending Approvals
        </p>

        <h3 class="text-3xl font-black mt-2">
            {{ $pendingApproval }}
        </h3>
    </div>

</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-sm">

        <div class="flex justify-between items-center mb-6">

            <h3 class="text-lg font-bold">
                Booking Trend
            </h3>

            <span class="text-xs uppercase tracking-widest text-[#D2C1B6]">
                Monthly
            </span>

        </div>

        <div id="bookingChart"></div>

    </div>

    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-sm">

        <div class="flex justify-between items-center mb-6">

            <h3 class="text-lg font-bold">
                Revenue Trend
            </h3>

            <span class="text-xs uppercase tracking-widest text-[#D2C1B6]">
                Last 7 Days
            </span>

        </div>

        <div id="revenueChart"></div>

    </div>

</div>

<div class="bg-white/5 border border-white/10 rounded-2xl overflow-hidden backdrop-blur-sm">

    <div class="p-6 border-b border-white/10">

        <h3 class="text-lg font-bold">

            Recent Bookings

        </h3>

    </div>

    <table class="w-full text-left text-white">

        <thead class="bg-white/5 text-[10px] uppercase font-black text-[#D2C1B6] tracking-widest">

            <tr>

                <th class="px-6 py-4">

                    Booking ID

                </th>

                <th class="px-6 py-4">

                    Customer

                </th>

                <th class="px-6 py-4">

                    Status

                </th>

                <th class="px-6 py-4 text-right">

                    Price

                </th>

            </tr>

        </thead>

        <tbody class="divide-y divide-white/5">

            @foreach($recentBookings ?? [] as $booking)

                <tr class="hover:bg-white/5 transition text-sm">

                    <td class="px-6 py-4 font-mono text-[#D2C1B6]">

                        #BK-{{ $booking->id }}

                    </td>

                    <td class="px-6 py-4 font-bold">

                        {{ $booking->user->name }}

                    </td>

                    <td class="px-6 py-4">

                        <span
                            class="px-3 py-1 rounded-full text-[10px] font-bold
                            {{ $booking->status == 'paid'
                                ? 'bg-emerald-500/10 text-emerald-400'
                                : 'bg-amber-500/10 text-amber-400' }}">

                            {{ strtoupper($booking->status) }}

                        </span>

                    </td>

                    <td class="px-6 py-4 text-right font-bold">

                        Rp {{ number_format($booking->total_price) }}

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</div>

<script src="https://code.highcharts.com/highcharts.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const months = @json($months);

    const bookingData = @json($bookingData);

    const revenueLabels = @json($revenueLabels);
    const revenueData = @json($revenueData);
    Highcharts.chart('bookingChart', {

        chart: {

            type: 'line',

            backgroundColor: 'transparent',

            height: 320

        },

        title: {

            text: null

        },

        xAxis: {

            categories: months,

            labels: {

                style: {

                    color: '#D2C1B6'

                }

            }

        },

        yAxis: {

            title: {

                text: null

            }

        },

        legend: {

            itemStyle: {

                color: '#FFFFFF'

            }

        },

        series: [{

            name: 'Bookings',

            data: bookingData

        }],

        credits: {

            enabled: false

        }

    });

    Highcharts.chart('revenueChart', {

        chart: {

            type: 'column',

            backgroundColor: 'transparent',

            height: 320

        },

        title: {

            text: null

        },

       xAxis: {
            categories: revenueLabels,
            
            labels: {

                style: {

                    color: '#D2C1B6'

                }

            }

        },

        yAxis: {

            title: {

                text: null

            }

        },

        tooltip: {

            pointFormat: 'Rp {point.y:,.0f}'

        },

        legend: {

            itemStyle: {

                color: '#FFFFFF'

            }

        },

        series: [{

            name: 'Revenue',

            data: revenueData

        }],

        credits: {

            enabled: false

        }

    });

});

</script>

@endsection