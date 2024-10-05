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
        Schema::create('smart_patient_cards', function (Blueprint $table) {
            $table->id();
            $table->string('template_name');
            $table->string('address');
            $table->string('header_color');
            $table->boolean('show_email')->default(1);
            $table->boolean('show_phone')->default(1);
            $table->boolean('show_dob')->default(1);
            $table->boolean('show_blood_group')->default(1);
            $table->boolean('show_address')->default(1);
            $table->boolean('show_patient_unique_id')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smart_patient_cards');
    }
};
