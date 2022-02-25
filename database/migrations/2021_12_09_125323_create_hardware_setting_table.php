<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHardwareSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hardware_setting', function (Blueprint $table) {
            $table->id();
            $table->string('attendance_ip')->nullable();
            $table->string('attendance_port')->nullable();
            $table->string('printer_ip')->nullable();
            $table->string('printer_port')->nullable();
            $table->string('printer_type')->nullable();
            $table->string('printer_path')->nullable();
            $table->integer('printer_char_per_line')->nullable();

            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
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
        Schema::dropIfExists('hardware_setting');
    }
}
