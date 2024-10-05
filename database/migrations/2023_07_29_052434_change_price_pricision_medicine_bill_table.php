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

        Schema::table('sale_medicines', function (Blueprint $table) {
            $table->float('sale_price', 25, 2)->change();
            $table->float('tax', 25, 2)->change();
            $table->float('amount', 25, 2)->change();
        });

        Schema::table('medicine_bills', function (Blueprint $table) {
            $table->float('discount', 25, 2)->change();
            $table->float('net_amount', 25, 2)->change();
            $table->float('total', 25, 2)->change();
            $table->float('tax_amount', 25, 2)->change();
            $table->datetime('bill_date')->after('note');
        });
        Schema::table('purchase_medicines', function (Blueprint $table) {
            $table->float('tax', 25, 2)->change();
            $table->float('total', 25, 2)->change();
            $table->float('discount', 25, 2)->change();
            $table->float('net_amount', 25, 2)->change();

        });
        Schema::table('purchased_medicines', function (Blueprint $table) {
            $table->float('tax', 25, 2)->change();
            $table->float('amount', 25, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
