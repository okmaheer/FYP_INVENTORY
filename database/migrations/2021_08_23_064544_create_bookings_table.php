<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('custom_booking_number')->nullable();
            $table->string('customer_option')->nullable();
            $table->string('sec_contact_no')->nullable();
            $table->string('event_area')->nullable();
            $table->date('event_date')->nullable();
            $table->string('no_person')->nullable();
            $table->string('event_time')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('rate_per_head')->nullable();
            $table->string('partition')->nullable();
            $table->json('venue')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('national_id_card')->nullable();
            $table->longText('address')->nullable();
            $table->longText('booking_detail')->nullable();
            $table->decimal('additional_charges',30,2)->nullable();
            $table->integer('event_type')->nullable();
            $table->foreignId('quot_id')->nullable();

            $table->date('delivery_date')->nullable();
            $table->time('delivery_time')->nullable();
            $table->text('delivery_address')->nullable();
            $table->decimal('delivery_charges',30,2)->nullable();

            $table->decimal('discount_total',30,2)->nullable();
            $table->integer('misc_discount_type')->nullable();
            $table->decimal('misc_discount_value',30,2)->nullable();
            $table->decimal('misc_discount_total',30,2)->nullable();
            $table->foreignId('tax_id')->nullable();
            $table->decimal('total_tax',30,2)->nullable();
            $table->decimal('grand_total',30,2)->nullable();
            $table->decimal('total_paid_amount',30,2)->nullable();
            $table->decimal('total_previous_amount',30,2)->nullable();
            $table->decimal('total_dues_amount',30,2)->nullable();
            $table->decimal('net_total',30,2)->nullable();
            $table->decimal('total_change_amount',30,2)->nullable();
            $table->integer('status')->default(0);

            $table->foreignId('processing_by')->nullable();
            $table->foreignId('confirmed_by')->nullable();

            $table->dateTime('processing_at')->nullable();
            $table->dateTime('confirmed_at')->nullable();
            $table->enum('is_child',[0,1])->default(0)->nullable();
            $table->foreignId('parent_booking_id')->nullable();

            $table->date('cancel_date')->nullable();
            $table->foreignId('canceled_by')->nullable();
            $table->text('canceled_remarks')->nullable();
            $table->integer('cancel_type')->nullable();
            $table->integer('refund_type')->nullable();
            $table->decimal('refund_total',30,2)->nullable();
            $table->decimal('refund_value',30,2)->nullable();
            $table->decimal('refund_amount',30,2)->nullable();
            $table->decimal('refund_remain',30,2)->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
