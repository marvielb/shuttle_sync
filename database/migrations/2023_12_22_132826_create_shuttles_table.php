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
        Schema::create('shuttles', function (Blueprint $table) {
            $table->id('shuttle_id');
            $table->foreignId('shuttle_driver_id')->constrained('users');
            $table->string('shuttle_model_name');
            $table->string('shuttle_plate_number');
            $table->integer('shuttle_capacity');
            $table->string('image_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shuttles');
    }
};
