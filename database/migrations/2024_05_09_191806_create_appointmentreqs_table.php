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
        Schema::create('appointmentreqs', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('type');
            $table->string('univnum');
            $table->string('request_type');
            $table->text('reason')->nullable();
            $table->string('date');
            $table->string('time');
            $table->string('remarks')->nullable()->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointmentreqs');
    }
};
