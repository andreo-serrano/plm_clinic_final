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
        Schema::create('user_logins', function (Blueprint $table) {
                $table->string('studentID')->primary();
                $table->string('user_type')->nullable;
                $table->string('password');
                $table->string('lastname');
                $table->string('firstname');
                $table->string('midname');
                $table->string('studage');
                $table->string('birthdate');
                $table->string('sex');
                $table->string('college');
                $table->string('program');
                $table->string('yearlev');
                $table->string('email')->unique();
                $table->string('enrollment');
                $table->string('mobnum');
                $table->string('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_logins');
    }
};
