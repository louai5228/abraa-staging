<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whatsapp_chat_messages', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('from');
            $table->string('to');
            $table->string('author')->nullable();
            $table->string('ack')->nullable();
            $table->string('body');
            $table->tinyInteger('fromMe')->nullable();
            $table->string('type');
            $table->tinyInteger('isForwarded')->nullable();
            $table->tinyInteger('isMentioned')->nullable();
            $table->json('mentionedIds')->nullable();
            $table->json('quotedMsg')->nullable();
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
        Schema::dropIfExists('whatsapp_chat_messages');
    }
};
