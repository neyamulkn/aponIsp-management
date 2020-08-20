<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_outs', function (Blueprint $table) {
            $table->id();
            $table->integer('stock_id');
            $table->string('type');
            $table->integer('stock_out_by')->nullable();
            $table->integer('available')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('price')->nullable();
            $table->date('date');
            $table->string('notes')->nullable();
            $table->integer('created_by');
            $table->string('status', 10)->nullable();
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
        Schema::dropIfExists('stock_outs');
    }
}
