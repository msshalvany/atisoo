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
        Schema::create('packeges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('imags');
            $table->text('mp3');
            $table->text('vedio');
            $table->bigInteger('id2');
            $table->text('zip');
            $table->text('description');
            $table->string('price');
            $table->integer('sort')->default(1);
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
        Schema::dropIfExists('packeges');
    }
};
