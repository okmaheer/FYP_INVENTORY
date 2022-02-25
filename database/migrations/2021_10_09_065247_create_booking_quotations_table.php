<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_quotations', function (Blueprint $table) {
            $table->id();
            $table->string('quot_number')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('event_area')->nullable();
            $table->date('event_date')->nullable();
            $table->string('no_person')->nullable();
            $table->string('event_time')->nullable();
            $table->string('rate_per_head')->nullable();
            $table->string('partition')->nullable();
            $table->json('venue')->nullable();
            $table->string('phone_number')->nullable();
            $table->longText('booking_detail')->nullable();
            $table->integer('event_type')->nullable();

            $table->date('delivery_date')->nullable();
            $table->string('delivery_time')->nullable();
            $table->text('delivery_address')->nullable();
            $table->decimal('delivery_charges',30,2)->nullable();

            $table->decimal('discount_total',30,2)->nullable();
            $table->decimal('misc_discount_total',30,2)->nullable();
            $table->decimal('grand_total',30,2)->nullable();
            $table->decimal('total_paid_amount',30,2)->nullable();
            $table->decimal('total_previous_amount',30,2)->nullable();
            $table->decimal('total_dues_amount',30,2)->nullable();
            $table->decimal('net_total',30,2)->nullable();
            $table->decimal('total_change_amount',30,2)->nullable();
            $table->enum('status', ['0', '1'])->default('0');

            $table->foreignId('processing_by')->nullable();
            $table->foreignId('confirmed_by')->nullable();

            $table->dateTime('processing_at')->nullable();
            $table->dateTime('confirmed_at')->nullable();
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
        Schema::dropIfExists('booking_quotations');
    }
}
