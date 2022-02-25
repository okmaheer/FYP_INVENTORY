<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyClosingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_closings', function (Blueprint $table) {
            $table->id();
            $table->float('last_day_closing')->nullable();
            $table->float('cash_in')->nullable();
            $table->float('cash_out')->nullable();
            $table->string('date')->nullable();
            $table->float('amount')->nullable();
            $table->float('adjustment')->nullable();
            $table->integer('status')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('daily_closings');
    }
}
