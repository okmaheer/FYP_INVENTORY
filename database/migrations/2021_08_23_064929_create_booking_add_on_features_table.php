<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingAddOnFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_add_on_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id');
            $table->foreignId('add_on_feature_id');

            $table->decimal('price',30,2)->nullable();
            $table->string('hourly')->nullable();
            $table->string('quantity')->nullable();
            $table->decimal('discount',30,2)->nullable();
            $table->decimal('net_total',30,2)->nullable();
            $table->decimal('total',30,2)->nullable();
            $table->text('details')->nullable();
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
        Schema::dropIfExists('booking_add_on_features');
    }
}
