<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotProductsUsedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quot_products_used', function (Blueprint $table) {
            $table->id();
            $table->string('quot_id');
            $table->string('product_id');
            $table->string('serial_no')->nullable();
            $table->string('description')->nullable();
            $table->decimal('used_qty')->nullable();
            $table->decimal('rate')->nullable();
            $table->float('supplier_rate')->nullable();
            $table->decimal('total_price')->nullable();
            $table->decimal('discount')->nullable();
            $table->string('discount_per')->nullable();
            $table->decimal('tax')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('quot_products_used');
    }
}
