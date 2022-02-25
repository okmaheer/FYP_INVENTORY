<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandHrDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demand_hr_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demand_id');
            $table->foreignId('employee_id');
            $table->foreignId('designation_id');

            $table->string('shift')->nullable();
            $table->string('timing')->nullable();
            $table->string('wage')->nullable();
            $table->string('total')->nullable();

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
        Schema::dropIfExists('demand_hr_details');
    }
}
