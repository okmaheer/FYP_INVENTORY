<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('app_setting')) {
            return true;
        }
        Schema::create('app_setting', function (Blueprint $table) {
            $table->id();
            $table->string('localhserver')->nullable();
            $table->string('onlineserver')->nullable();
            $table->string('hotspot')->nullable();
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
        Schema::dropIfExists('app_setting');
    }
}
