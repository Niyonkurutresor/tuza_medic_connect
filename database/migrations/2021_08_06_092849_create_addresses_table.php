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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('owner_id')->nullable();
            $table->string('owner_type')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('postal_code')->nullable();
            $table->timestamps();

            $table->foreign('country_id')->on('countries')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('state_id')->on('states')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->on('cities')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
