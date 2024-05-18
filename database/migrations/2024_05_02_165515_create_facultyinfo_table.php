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
        Schema::create('facultyinfo', function (Blueprint $table) {
            $table->string('facultyID')->primary();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('midname');
            $table->string('birthdate');
            $table->string('gender');
            $table->string('job_position');
            $table->string('employment_type');
            $table->string('plmemail')->unique();
            $table->string('peremail')->unique();
            $table->string('mobnum');
            $table->string('emergencymobnum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facultyinfo');
    }
};
