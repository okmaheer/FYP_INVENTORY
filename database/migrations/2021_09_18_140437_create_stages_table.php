<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->string('custom_stage_number')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->string('category')->nullable();
            $table->foreignId('booking_id')->nullable();
            $table->string('custom_booking_number')->nullable();
            $table->string('event_time')->nullable();
            $table->date('event_date')->nullable();
            $table->string('booking_detail')->nullable();

            $table->decimal('discount_total',30,2)->nullable();
            $table->decimal('misc_discount_total',30,2)->nullable();
            $table->decimal('grand_total',30,2)->nullable();
            $table->decimal('total_paid_amount',30,2)->nullable();
            $table->decimal('total_previous_amount',30,2)->nullable();
            $table->decimal('total_dues_amount',30,2)->nullable();
            $table->decimal('net_total',30,2)->nullable();
            $table->decimal('total_change_amount',30,2)->nullable();

            $table->foreignId('processing_by')->nullable();
            $table->foreignId('confirmed_by')->nullable();

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
        Schema::dropIfExists('stages');
    }
}
