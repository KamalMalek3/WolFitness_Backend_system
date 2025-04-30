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
        Schema::create('workouts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('muscle_id');
            $table->string('name');
            $table->string('video_male_url')->nullable();
            $table->string('video_female_url')->nullable();

            $table->foreign('muscle_id')->references('id')->on('muscles')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('workouts');
    }
    
};
