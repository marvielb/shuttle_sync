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
            $table->id('id');
            $table->foreignId('driver_id')->constrained('users');
            $table->string('model_name');
            $table->string('plate_number');
            $table->integer('capacity');
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
