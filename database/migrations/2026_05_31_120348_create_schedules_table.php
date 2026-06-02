<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Schedule;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            $table->foreignId('studio_id')->constrained()->onDelete('cascade');
            $table->date('show_date');
            $table->time('show_time');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }

    public function seats(Schedule $schedule)
    {
        $schedule->load('seats');

        return view('schedules.seats', compact('schedule'));
    }
};
