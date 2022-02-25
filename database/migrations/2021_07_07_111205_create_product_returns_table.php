<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_returns', function (Blueprint $table) {
            $table->id();
            $table->integer('return_id')->unique();
            $table->string('product_id');
            $table->string('invoice_id');
            $table->string('purchase_id')->nullable();
            $table->string('date_purchase');
            $table->string('date_return');
            $table->float('byy_qty');
            $table->float('ret_qty');
            $table->string('customer_id');
            $table->string('supplier_id');
            $table->decimal('product_rate');
            $table->float('deduction');
            $table->decimal('total_deduct');
            $table->decimal('total_tax');
            $table->decimal('total_ret_amount');
            $table->decimal('net_total_amount');
            $table->text('reason');
            $table->integer('usablity');
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
        Schema::dropIfExists('product_returns');
    }
}
