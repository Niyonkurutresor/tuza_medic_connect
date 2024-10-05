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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('name');
            $table->double('selling_price');
            $table->double('buying_price');
            $table->integer('quantity');
            $table->integer('available_quantity');
            $table->string('salt_composition');
            $table->text('description')->nullable();
            $table->text('side_effects')->nullable();
            $table->string('currency_symbol', 100)->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
