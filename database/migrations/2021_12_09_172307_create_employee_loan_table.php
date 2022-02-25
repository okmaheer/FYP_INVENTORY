<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeLoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_loan', function (Blueprint $table) {
            $table->id();
            $table->string('loan_no')->nullable();
            $table->foreignId('employee_id')->nullable();
            $table->date('date')->nullable();
            $table->decimal('loan_amount')->nullable();
            $table->integer('return_type')->nullable();
            $table->date('return_date')->nullable();
            $table->integer('deduct_type')->nullable();
            $table->decimal('deduct_value', 30, 2)->nullable();
            $table->decimal('deduct_amount', 30, 2)->nullable();
            $table->integer('status')->nullable();
            $table->text('status_details')->nullable();
            $table->text('details')->nullable();

            $table->foreignId('requested_by')->nullable();
            $table->foreignId('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('received_at')->nullable();
            $table->foreignId('received_by')->nullable();

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
        Schema::dropIfExists('employee_loan');
    }
}
