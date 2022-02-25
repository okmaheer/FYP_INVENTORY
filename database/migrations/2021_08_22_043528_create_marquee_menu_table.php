<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarqueeMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marquee_menu', function (Blueprint $table) {

            $table->id();
            $table->string('menu_type')->nullable();
            $table->string('menu_no')->nullable();
            $table->string('menu_name')->unique()->nullable();
            $table->longText('menu_specific')->nullable();
            $table->string('menu_add_on')->nullable();

            $table->string('base_material')->nullable();
            $table->string('solution')->nullable();
            $table->string('patawa')->nullable();
            $table->string('thread')->nullable();
            $table->string('ornament')->nullable();
            $table->string('other')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marquee_menu');
    }
}
