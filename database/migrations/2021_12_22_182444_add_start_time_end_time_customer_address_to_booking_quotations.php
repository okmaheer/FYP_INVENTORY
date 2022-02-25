<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStarttimeEndtimeCustomerAddressToBookingQuotations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_quotations', function (Blueprint $table) {
            $table->time('start_time')->after('event_time')->nullable();
            $table->time('end_time')->after('start_time')->nullable();
            $table->text('customer_address')->after('customer_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_quotations', function (Blueprint $table) {
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
            $table->dropColumn('customer_address');
        });
    }
}
