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
        Schema::create('labresults', function (Blueprint $table) {
            $table->id();
            $table->string('appid');
            $table->string('univnum');
            $table->text('current_condition');
            $table->text('diagnosis');
            $table->text('treatment_plan');
            $table->text('remarks');
            $table->string('lab_results_file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labresults');
    }
};
