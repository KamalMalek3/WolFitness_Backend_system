<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weekly_schedule', function (Blueprint $table) {
            $table->id(); // Keep this as primary key for schedule
            $table->unsignedTinyInteger('day_number')->comment('1 for Monday, ..., 7 for Sunday');
        
            $table->uuid('workout_id'); // <-- Fix: use uuid instead of foreignId
            $table->integer('duration')->comment('Duration in minutes');
            $table->string('notes')->nullable()->comment('Additional notes for the schedule');
            $table->timestamps();
        
            $table->foreign('workout_id')->references('id')->on('workouts')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_schedule');
    }
};
