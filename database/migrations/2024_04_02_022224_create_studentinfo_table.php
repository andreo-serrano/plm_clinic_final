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
        Schema::create('studentinfo', function (Blueprint $table) {
            $table->string('studentID')->primary();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('midname');
            $table->string('birthdate');
            $table->string('gender');
            $table->string('college');
            $table->string('program');
            $table->string('yearlev');
            $table->string('plmemail')->unique();
            $table->string('peremail')->unique();
            $table->string('mobnum');
            $table->string('guardian');
            $table->string('guardmobnum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentinfo');
    }
};
