<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatePassHardwareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gate_pass_hardware', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gatepass_id');
            $table->foreignId('product_id');
            $table->foreignId('booking_id');
            $table->decimal('quantity')->nullable();
            $table->string('packing')->nullable();
            $table->string('description')->nullable();
            $table->decimal('total_items',30,4)->nullable();
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
        Schema::dropIfExists('gate_pass_hardware');
    }
}
