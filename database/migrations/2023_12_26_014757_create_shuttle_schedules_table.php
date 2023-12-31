<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shuttle_schedules', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('shuttle_id')->constrained('shuttles', 'id');
            $table->foreignId('time_slot_id')->constrained('time_slots', 'id');
            $table->foreignId('from_location_id')->constrained('locations', 'id');
            $table->foreignId('to_location_id')->constrained('locations', 'id');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shuttle_schedules');
    }
};
