<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalarySetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_setups', function (Blueprint $table) {
            $table->id();
            $table->integer('e_s_s_id');
            $table->string('employee_id');
            $table->string('sal_type');
            $table->string('salary_type_id');
            $table->decimal('amount');
            $table->date('create_date')->nullable();
            $table->dateTime('update_date')->nullable();
            $table->string('update_id');
            $table->float('gross_salary');
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
        Schema::dropIfExists('salary_setups');
    }
}
