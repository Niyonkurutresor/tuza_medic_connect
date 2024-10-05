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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id');
            $table->unsignedInteger('patient_id');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->string('food_allergies')->nullable();
            $table->string('tendency_bleed')->nullable();
            $table->string('heart_disease')->nullable();
            $table->string('high_blood_pressure')->nullable();
            $table->string('diabetic')->nullable();
            $table->string('surgery')->nullable();
            $table->string('accident')->nullable();
            $table->string('others')->nullable();
            $table->string('medical_history')->nullable();
            $table->string('current_medication')->nullable();
            $table->string('female_pregnancy')->nullable();
            $table->string('breast_feeding')->nullable();
            $table->string('health_insurance')->nullable();
            $table->string('low_income')->nullable();
            $table->string('reference')->nullable();
            $table->boolean('status')->nullable();
            $table->string('plus_rate', 100)->nullable();
            $table->string('temperature', 100)->nullable();
            $table->string('problem_description', 100)->nullable();
            $table->string('test', 100)->nullable();
            $table->string('advice', 100)->nullable();
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('doctor_id')->references('id')->on('doctors')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
