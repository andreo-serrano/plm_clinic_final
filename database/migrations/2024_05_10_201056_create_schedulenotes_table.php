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
        Schema::create('schedulenotes', function (Blueprint $table) {
            $table->id();
            $table->string('univnum');
            $table->string('todo_date');
            $table->string('todo_title');
            $table->string('todo_startTime');
            $table->string('todo_endTime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedulenotes');
    }
};
