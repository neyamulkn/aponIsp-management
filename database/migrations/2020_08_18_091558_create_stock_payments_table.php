<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id')->nullable();
            $table->integer('shop_id');
            $table->string('invoice',15)->nullable();
            $table->decimal('buy')->nullable();
            $table->decimal('buy_return')->nullable();
            $table->decimal('amount')->nullable();
            $table->string('payment_method', 10)->nullable();
            $table->string('cheque_no', 10)->nullable();
            $table->string('notes')->nullable();
            $table->integer('payment_by');
            $table->dateTime('payment_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_payments');
    }
}
