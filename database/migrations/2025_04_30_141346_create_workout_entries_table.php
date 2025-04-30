<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('workout_entries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('personal_workout_id');
            $table->uuid('workout_id');
            $table->integer('sets');
            $table->float('time')->nullable();
            $table->integer('reps')->nullable();

            $table->foreign('personal_workout_id')->references('id')->on('personal_workouts')->onDelete('cascade');
            $table->foreign('workout_id')->references('id')->on('workouts')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('workout_entries');
    }
};
