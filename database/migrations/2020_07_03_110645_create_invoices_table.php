<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id')->nullable();
            $table->char('invoice_id', 10);
            $table->date('due_date');
            $table->date('pay_month')->nullable();
            $table->integer('user_id');
            $table->integer('package_id');
            $table->decimal('amount')->default(0);
            $table->decimal('paid_amount')->default(0);
            $table->integer('discount')->default(0)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('pay_method')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
