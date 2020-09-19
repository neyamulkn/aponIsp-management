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
            $table->integer('fiber_id');
            $table->integer('fiber_core_no');
            $table->integer('spliter_id')->nullable();
            $table->integer('fiber_miter')->nullable();
            $table->string('join_location')->nullable();

            $table->integer('connect_type')->comment('1=fiber,2=onu');
            $table->integer('out_fiber_id',)->nullable();
            $table->integer('out_fiber_core_no')->nullable();
            $table->integer('out_spliter_id')->nullable();
            $table->integer('out_fiber_miter')->nullable();
            $table->integer('next_tj_id')->nullable();
            $table->string('onu_mac', 55)->nullable();
            $table->integer('box_id')->nullable();
            $table->string('user', 55)->nullable();
            $table->integer('staff_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->string('notes')->nullable();
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
