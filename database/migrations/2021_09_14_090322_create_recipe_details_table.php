<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->nullable();
            $table->foreignId('product_id')->nullable();
            $table->decimal('wastage')->nullable();
            $table->decimal('final_quantity')->nullable();
            $table->string('unit')->nullable();
            $table->decimal('price',30,4)->nullable();
            $table->decimal('total_amount',30,4)->nullable();
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
        Schema::dropIfExists('recipe_details');
    }
}
