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
        Schema::create('rset_cams', function (Blueprint $table) {
            $table->id();
            $table->text('mp3');
            $table->text('vedio');
            $table->text('apps');
            $table->text('imags');
            $table->bigInteger('id2');
            $table->text('description');
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
        Schema::dropIfExists('rset_cams');
    }
};
