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
        Schema::create('whatsapp_chats', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->tinyInteger('isReadOnly')->default(0);
            $table->tinyInteger('isGroup')->default(0);
            $table->tinyInteger('archived')->default(0);
            $table->tinyInteger('pinned')->default(0);
            $table->tinyInteger('isMuted')->default(0);
            $table->integer('unread')->default(0);
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
        Schema::dropIfExists('whatsapp_chats');
    }
};
