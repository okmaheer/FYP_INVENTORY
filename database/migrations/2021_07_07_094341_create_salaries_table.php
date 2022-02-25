<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->string('salary_no')->nullable();
            $table->foreignId('employee_id');
            $table->string('salary_month')->nullable();
            $table->decimal('total_salary', 30, 2)->nullable();
            $table->decimal('paid_salary', 30, 2)->nullable();
            $table->integer('attendance')->nullable();
            $table->integer('present')->nullable();
            $table->decimal('deduction', 30, 2)->nullable();
            $table->integer('deduction_type')->nullable();
            $table->text('deduction_reason')->nullable();
            $table->foreignId('generated_by');
            $table->foreignId('paid_by')->nullable();
            $table->date('paid_at')->nullable();
            $table->foreignId('received_by')->nullable();
            $table->integer('type')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('salaries');
    }
}
