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
        Schema::create('medicine_bills', function (Blueprint $table) {
            $table->id();
            $table->string('bill_number');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->string('model_type');
            $table->string('model_id');
            $table->float('discount');
            $table->float('net_amount');
            $table->float('total');
            $table->float('tax_amount');
            $table->integer('payment_status');
            $table->integer('payment_type');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine_bills');
    }
};
