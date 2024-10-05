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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedInteger('patient_id');
            $table->string('date');
            $table->string('from_time');
            $table->string('from_time_type');
            $table->string('to_time');
            $table->string('to_time_type');
            $table->boolean('status')->default(1);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('service_id');
            $table->string('payable_amount');
            $table->string('appointment_unique_id');
            $table->timestamps();

            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('appointments');
    }
};
