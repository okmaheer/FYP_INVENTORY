<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyBankingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_banking', function (Blueprint $table) {

            $table->id();
            $table->foreignId('bank_id')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('deposit_type')->nullable();
            $table->string('transaction_type')->nullable();
            $table->text('description')->nullable();
            $table->integer('amount')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('daily_banking');
    }
}
