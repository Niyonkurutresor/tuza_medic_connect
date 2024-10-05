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
        Schema::create('live_consultations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedInteger('patient_id');
            $table->string('consultation_title');
            $table->dateTime('consultation_date');
            $table->boolean('host_video');
            $table->boolean('participant_video');
            $table->string('consultation_duration_minutes');
            $table->string('created_by');
            $table->integer('status')->nullable();
            $table->text('description')->nullable();
            $table->string('meeting_id')->nullable();
            $table->text('meta')->nullable();
            $table->string('time_zone')->nullable();
            $table->string('password')->nullable();

            $table->timestamps();

            $table->foreign('doctor_id')->references('id')->on('doctors')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('patient_id')->references('id')->on('patients')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_consultations');
    }
};
