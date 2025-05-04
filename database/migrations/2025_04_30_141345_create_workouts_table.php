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
            $table->string('name');
            $table->string('video_male_url')->nullable();
            $table->string('video_female_url')->nullable();
        });
    }
    public function down(): void {
        Schema::dropIfExists('workouts');
    }
    
};
