<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id')->nullable();
            $table->string('router_id')->nullable();
            $table->string('pkg_name', 65);
            $table->string('bandwidth', 65);
            $table->decimal('price', 8, 2);
            $table->integer('discount')->nullable();
            $table->string('details')->nullable();
            $table->string('connection_type', 15)->nullable()->comment('HotSpot/wifi, PPOE');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('status')->default(1);
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
        Schema::dropIfExists('packages');
    }
}
