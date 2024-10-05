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
        Schema::create('session_week_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('doctor_session_id')->constrained('doctor_sessions')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('day_of_week');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('start_time_type');
            $table->string('end_time_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_week_days');
    }
};
