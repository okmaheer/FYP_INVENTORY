<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('per_loan_id')->unique();
            $table->string('transaction_id');
            $table->string('person_id');
            $table->decimal('debit')->nullable();
            $table->decimal('credit');
            $table->string('date');
            $table->string('details');
            $table->integer('status');
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
        Schema::dropIfExists('personal_loans');
    }
}
