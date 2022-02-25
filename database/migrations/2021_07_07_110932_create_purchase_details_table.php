<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('purchase_details')) {
            return true;
        }
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->nullable();
            $table->foreignId('product_id')->nullable();
            $table->decimal('quantity',30,2)->nullable();
            $table->decimal('rate',30,2)->nullable();
            $table->decimal('tax_amount',30,2)->nullable();
            $table->decimal('tax_p',30,2)->nullable();
            $table->decimal('total_amount',30,2)->nullable();
            $table->float('discount')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('purchase_details');
    }
}
