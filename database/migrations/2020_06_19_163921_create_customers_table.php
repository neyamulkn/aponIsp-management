<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->date('pay_date')->nullable()->comment('every month pay date');
            $table->string('location_point')->nullable();
            $table->string('connection_type')->nullable();
            $table->string('connectivity_type')->nullable();

            $table->integer('package_id')->nullable();
            $table->string('bandwidth')->nullable();
            $table->string('amount')->nullable();
            $table->string('allowcated_ip')->nullable();
            $table->string('mac')->nullable();
            $table->string('discount')->nullable();
            $table->integer('box_id')->nullable();
            $table->integer('cable_id')->nullable();
            $table->integer('reseller_id')->nullable();
            $table->integer('marketing_by')->nullable();
            $table->integer('setup_by')->nullable();
            $table->char('ref_by', 15)->nullable();
            $table->integer('status')->default(1);
            $table->string('comment')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('customers');
    }
}
