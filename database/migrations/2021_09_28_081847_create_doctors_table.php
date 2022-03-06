<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('icon')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('o_time')->nullable();
            $table->string('c_time')->nullable();
            $table->string('clinic_pic')->nullable();
            $table->string('year_exp')->nullable();
            $table->string('ig_username')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('location_id')->nullable();
            $table->string('address')->nullable();
            $table->string('specialist_id')->nullable();
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
        Schema::dropIfExists('doctors');
    }
}
