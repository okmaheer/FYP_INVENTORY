<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePettycashsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pettycashs', function (Blueprint $table) {
            $table->id();
            $table->string('pettycash_name')->nullable();
            $table->string('pettycash_mobile')->nullable();
            $table->string('pettycash_email')->nullable();
            $table->string('cnic')->nullable();
            $table->string('phone')->nullable();
            $table->integer('contact')->nullable();
            $table->string('pettycash_address')->nullable();
            $table->string('address2')->nullable();
            $table->string('fax')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();
            $table->string('previous_balance')->nullable();
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
        Schema::dropIfExists('pettycashs');
    }
}
