<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_conversations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ticket_id');
            $table->unsignedInteger('from_user');
            $table->unsignedInteger('to_user')->nullable();
            $table->mediumText('conversation')->nullable();
            $table->char('image', 15)->nullable();
            $table->char('file', 15)->nullable();
            $table->tinyInteger('seen')->default(0);
            $table->dateTime('ticket_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_conversations');
    }
}
