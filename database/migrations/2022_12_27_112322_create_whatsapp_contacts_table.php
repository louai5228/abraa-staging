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
        Schema::create('whatsapp_contacts', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('number');
            $table->string('name')->nullable();
            $table->string('pushname')->nullable();
            $table->tinyInteger('isMe')->default(0);
            $table->tinyInteger('isGroup')->default(0);
            $table->tinyInteger('isBusiness')->default(0);
            $table->tinyInteger('isEnterprise')->default(0);
            $table->tinyInteger('isMyContact')->default(0);
            $table->tinyInteger('isBlocked')->default(0);
            $table->tinyInteger('isMuted')->default(0);
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
        Schema::dropIfExists('whatsapp_contacts');
    }
};
