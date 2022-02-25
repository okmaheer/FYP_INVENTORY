<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingExtraFoodItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_extra_food_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->nullable();
            $table->foreignId('extra_food_item_id')->nullable();

            $table->decimal('price',30,2)->nullable();
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
        Schema::dropIfExists('booking_extra_food_items');
    }
}
