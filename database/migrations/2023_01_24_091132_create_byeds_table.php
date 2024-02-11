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
        Schema::create('byeds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userId');
            $table->bigInteger('deviceId');
            $table->string('flash');
            $table->string('iprom');
            $table->bigInteger('updateFile_id')->default(0);
            $table->bigInteger('package_id')->default(0);
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
        Schema::dropIfExists('byeds');
    }
};
