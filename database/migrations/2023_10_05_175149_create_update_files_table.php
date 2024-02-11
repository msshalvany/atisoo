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
        Schema::create('update_files', function (Blueprint $table) {
            $table->id();
            $table->string('name1');
            $table->string('name2');
            $table->string('name3');
            $table->text('flash');
            $table->string('Price');
            $table->string('ic');
            $table->string('path');
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
        Schema::dropIfExists('update_files');
    }
};
