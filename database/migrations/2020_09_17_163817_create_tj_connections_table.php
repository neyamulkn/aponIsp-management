<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTjConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tj_connections', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id')->nullable();
            $table->integer('tj_id');
            $table->integer('fiber_start');
            $table->integer('core_start');
            $table->integer('extend_spliter_start')->nullable();
            $table->integer('extend_spliter_core_start')->nullable();
            $table->integer('fiber_miter_start')->nullable();
            $table->string('details_start')->nullable();

            $table->string('connect_type', 8)->comment('1=fiber,2=onu');
            $table->integer('connectBy');
            $table->integer('fiber_out')->nullable();
            $table->integer('core_out')->nullable();
            $table->integer('extend_spliter_out')->nullable();
            $table->integer('extend_spliter_core_out')->nullable();
            $table->integer('fiber_miter_out')->nullable();
            $table->integer('join_tj')->nullable();
            $table->string('onu_mac', 55)->nullable();
            $table->integer('box')->nullable();
            $table->string('user', 55)->nullable();
            $table->string('details_out')->nullable();

            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('tj_connections');
    }
}
