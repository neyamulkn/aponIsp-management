<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id')->default(3);
            $table->string('vendor_name');
            $table->string('username');
            $table->string('vendor_dsc')->nullable();
            $table->decimal('balance')->default(0.00);
            $table->string('email');
            $table->string('phone');
            $table->string('country', 25)->nullable();
            $table->string('state', 25)->nullable();
            $table->string('city', 25)->nullable();
            $table->string('zip_code', 15)->nullable();
            $table->string('address')->nullable();
            $table->dateTime('expire_date')->nullable();
            $table->string('logo')->default('default.png');
            $table->string('password', 75);
            $table->string('temp_password', 15)->nullable();
            $table->string('reset_key', 75)->nullable();
            $table->dateTime('last_login')->nullable();
            $table->timestamp('join_date');
            $table->integer('referral_by')->nullable();
            $table->decimal('referral_amount')->default(0.00);
            $table->integer('total_referral')->default(0);
            $table->tinyInteger('email_verified')->nullable();
            $table->tinyInteger('sms_verified')->nullable();
            $table->string('email_ver_code', 25)->nullable();
            $table->string('sms_ver_code', 25)->nullable();
            $table->integer('email_sent')->default(0);
            $table->integer('sms_sent')->default(0);
            $table->integer('vsent')->default(0);
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
            $table->string('remember_token')->nullable();
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
        Schema::dropIfExists('vendors');
    }
}
