<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id')->nullable();
            $table->char('invoice_id', 10);
            $table->integer('pay_method');
            $table->char('transaction_id', 25)->nullable();
            $table->char('payer_id', 25)->nullable();
            $table->char('payer_mail', 25)->nullable();
            $table->char('cheque_number', 25)->nullable();
            $table->char('bank_account_number', 25)->nullable();
            $table->char('card_number', 25)->nullable();
            $table->char('card_type', 25)->nullable();
            $table->char('card_holder_name', 25)->nullable();
            $table->char('currency', 10)->nullable();
            $table->unsignedInteger('user_id');
            $table->date('payment_date');
            $table->date('pay_month');
            $table->decimal('amount');
            $table->unsignedInteger('created_by')->default(0);
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
