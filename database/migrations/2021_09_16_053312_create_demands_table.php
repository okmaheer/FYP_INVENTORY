<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * wb = with booking
         * wob = without booking
         */
        Schema::create('demands', function (Blueprint $table) {
            $table->id();
            $table->string('custom_booking_number')->nullable();

            $table->enum('belongs',['wb','wob'])->default('wb');
            $table->string('demand_type')->default('6');
            $table->string('generated_by');
            $table->longText('narration');
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
        Schema::dropIfExists('demands');
    }
}
