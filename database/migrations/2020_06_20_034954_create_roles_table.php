<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->char('name', 15)->comment('1=admin, 2=vendor, 3=staff, 4=user');
            $table->char('slug', 15);
            $table->string('notes')->nullable();
            $table->tinyInteger('is_default')->nullable();
            $table->tinyInteger('is_super_admin')->default(0);
            $table->tinyInteger('status')->detault(1);
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
        Schema::dropIfExists('roles');
    }
}
