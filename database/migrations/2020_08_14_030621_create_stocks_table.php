<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('shop_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->string('name', 75);
            $table->string('code', 25)->nullable();
            $table->string('serial', 25)->nullable();
            $table->string('model', 25)->nullable();
            $table->string('mac', 25)->nullable();
            $table->string('port', 25)->nullable();
            $table->string('quantity', 50)->nullable();
            $table->string('available', 50)->nullable();
            $table->string('warranty', 50)->nullable();
            $table->integer('price')->default(0);
            $table->date('date')->nullable();
            $table->string('notes')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('stocks');
    }
}
