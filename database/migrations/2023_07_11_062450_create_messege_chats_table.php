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
        Schema::create('messege_chats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('chat_id');
            $table->text('text');
            $table->text('image')->nullable();
            $table->text('voice')->nullable();
            $table->text('file')->nullable();
            $table->boolean('hide')->default(0);
            $table->bigInteger('reply')->default(0);
            $table->bigInteger('admin_id')->default(0);
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
        Schema::dropIfExists('messege_chats');
    }
};
