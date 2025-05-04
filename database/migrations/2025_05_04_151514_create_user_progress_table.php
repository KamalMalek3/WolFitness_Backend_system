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
            Schema::create('user_progresses', function (Blueprint $table) {
                $table->uuid('id')->primary();
        
                $table->uuid('user_id');
                $table->unsignedBigInteger('weekly_schedule_id'); // keeping this int since weekly_schedule uses int PK
        
                $table->integer('duration_completed')->comment('Duration completed in minutes');
                $table->date('date')->comment('Date of the progress update');
        
                $table->timestamps();
        
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('weekly_schedule_id')->references('id')->on('weekly_schedule')->onDelete('cascade');
            });
        }
        
        public function down(): void {
            Schema::dropIfExists('user_progresses');
        }
        
};
