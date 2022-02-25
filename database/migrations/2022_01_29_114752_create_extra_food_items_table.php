<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraFoodItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_food_items', function (Blueprint $table) {
            $table->id();
            $table->string('barcode')->nullable();
            $table->string('name')->nullable();
            $table->string('price')->nullable();
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
        Schema::dropIfExists('extra_food_items');
    }
}
