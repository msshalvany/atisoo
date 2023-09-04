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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('name1');
            $table->string('name2');
            $table->string('name3');
            $table->text('iprom');
            $table->text('flash');
            $table->string('ipromPrice');
            $table->string('flashPrice');
            $table->string('flashSize');
            $table->string('ic');
            $table->string('path');
            $table->string('ipromName');
            $table->string('password');
            $table->string('lable');
            $table->string('chanel');
            $table->text('description');
            $table->text('imags');
            $table->bigInteger('id2')->default(1);
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
        Schema::dropIfExists('devices');
    }
};
