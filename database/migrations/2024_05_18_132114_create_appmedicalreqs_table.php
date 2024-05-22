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
        Schema::create('appmedicalreqs', function (Blueprint $table) {
            $table->id();
            $table->string('appid');
            $table->string('type');
            $table->string('date');
            $table->string('time');
            $table->string('patient_concern');
            $table->text('remarks')->nullable();
            $table->string('status')->nullable()->default('Approved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appmedicalreqs');
    }
};
