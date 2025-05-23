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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('full_name');
            $table->string('phone_number')->unique(); // phone number with country code
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken(); // for Laravel auth sessions
            $table->timestamps();
        });
    }
    
    public function down(): void {
        Schema::dropIfExists('users');
    }
    
};
