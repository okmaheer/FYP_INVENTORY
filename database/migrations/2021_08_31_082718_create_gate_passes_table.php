<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatePassesTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('gate_passes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id');
            $table->string('customer_name')->nullable();
            $table->string('event_area')->nullable();
       
            $table->string('event_date')->nullable();
            $table->string('issue_by')->nullable();
            $table->string('issue_date')->nullable();
            $table->string('gatepass_no')->nullable();
            $table->longText('phone_number')->nullable();
            $table->longText('national_id_card')->nullable();
            $table->longText('event_time')->nullable();
            $table->longText('address')->nullable();
            $table->longText('receive_date')->nullable();
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
        Schema::dropIfExists('gate_passes');
    }
}
