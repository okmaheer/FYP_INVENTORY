<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBookingExtraFoodItemTableAddQuantityOfField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_extra_food_items', function (Blueprint $table) {
            
            $table->decimal('quantity',30,2)->after('price')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_extra_food_items', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
}
