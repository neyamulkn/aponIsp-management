<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->default('logo.png');
            $table->string('favicon')->default('favicon.png');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('tags')->nullable();
            $table->string('about')->nullable();
            $table->text('header')->nullable();
            $table->text('footer')->nullable();
            $table->char('phone', 150)->nullable();
            $table->char('email', 150)->nullable();

            $table->tinyInteger('slider')->default(1);
            $table->tinyInteger('services')->default(1);
            $table->tinyInteger('banner_large')->default(1);
            $table->tinyInteger('banner_small')->default(1);
            $table->tinyInteger('banner_towImg')->default(1);
            $table->tinyInteger('banner_threeImg')->default(1);
            $table->tinyInteger('banner_leftRight')->default(1);
           
            $table->tinyInteger('registration')->nullable();
            $table->tinyInteger('email_verification')->nullable();
            $table->tinyInteger('sms_verification')->nullable();
            $table->tinyInteger('email_notification')->nullable();
            $table->tinyInteger('sms_notification')->nullable();

            $table->tinyInteger('blog')->default(1);
            $table->tinyInteger('patner')->default(1);
            $table->tinyInteger('reviews')->default(1);
            $table->tinyInteger('newsletters')->default(1);
            $table->tinyInteger('is_loader')->default(1);

            $table->string('smtp_host')->default(1);
            $table->string('smtp_port')->default(1);
            $table->string('smtp_user')->default(1);
            $table->string('smtp_pass')->default(1);
            $table->string('date_format')->default('j M, Y');
            $table->string('currency', 25)->default('USD');
            $table->string('currency_symble', 15)->default('$');
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
        Schema::dropIfExists('general_settings');
    }
}
