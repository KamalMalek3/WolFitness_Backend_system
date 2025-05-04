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
        Schema::create('user_personal_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->unique(); // Ensure one-to-one relationship
    
            $table->string('profile_picture')->nullable();
            $table->integer('age');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->decimal('weight', 5, 2); // kg, up to 999.99
            $table->decimal('height', 5, 2); // cm, up to 999.99
    
            $table->timestamps();
    
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
    public function down(): void {
        Schema::dropIfExists('user_personal_details');
    }
    
};
