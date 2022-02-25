<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStageQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stage_quotations', function (Blueprint $table) {
            $table->id();
            $table->string('quot_number')->nullable();
            $table->string('customer_name')->nullable();
            $table->date('event_date')->nullable();
            $table->string('event_time')->nullable();
            $table->string('rate_per_head')->nullable();
            $table->string('phone_number')->nullable();
            $table->longText('booking_detail')->nullable();

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
        Schema::dropIfExists('stage_quotations');
    }
}
