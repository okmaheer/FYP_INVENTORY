<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTentativeBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tentative_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('tentative_number')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('customer_address')->nullable();
            $table->string('event_area')->nullable();
            $table->date('event_date')->nullable();
            $table->string('event_time')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('no_person')->nullable();
            $table->string('rate_per_head')->nullable();
            $table->string('partition')->nullable();
            $table->json('venue')->nullable();
            $table->longText('booking_detail')->nullable();
            $table->integer('event_type')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('delivery_time')->nullable();
            $table->text('delivery_address')->nullable();
            $table->decimal('delivery_charges',30,2)->nullable();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
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
        Schema::dropIfExists('tentative_bookings');
    }
}
