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
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->text('indexKey');
            $table->text('searchFlashKey');
            $table->text('searchUpdateKey');
            $table->text('byFlahYouKey'); 
            $table->text('byUpdateYouKey'); 
            $table->text('resetDeviceKey'); 
            $table->text('resetCamKey'); 
            $table->text('deviceKey'); 
            $table->text('logo');
            $table->text('ruls');
            $table->text('ibaladam');
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
        Schema::dropIfExists('infos');
    }
};
