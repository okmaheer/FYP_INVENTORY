<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('VNo')->nullable();
            $table->string('Vtype')->nullable();
            $table->date('VDate')->nullable();
            $table->string('COAID');
            $table->text('Narration')->nullable();
            $table->decimal('Debit',30,2)->nullable();
            $table->decimal('Credit',30,2)->nullable();
            $table->char('IsPosted')->nullable();
            $table->integer('is_opening')->nullable();
            $table->foreignId('booking_id')->nullable();
            $table->foreignId('stage_id')->nullable();
            $table->char('IsAppove')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
