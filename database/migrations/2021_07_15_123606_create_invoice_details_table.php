<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->nullable();
            $table->foreignId('product_id')->nullable();
            $table->text('description')->nullable();
            $table->decimal('quantity',30,2)->nullable();
            $table->decimal('supplier_rate',30,2)->default("0.00")->nullable();
            $table->decimal('rate',30,2)->default("0.00")->nullable();
            $table->decimal('total_price',30,2)->default("0.00")->nullable();
            $table->decimal('discount',30,2)->default("0.00")->nullable();
            $table->decimal('tax_p',30,2)->default("0.00")->nullable();
            $table->decimal('tax_amount',30,2)->default("0.00")->nullable();
            $table->decimal('discount_per')->default("0.00")->nullable();
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
        Schema::dropIfExists('invoice_details');
    }
}
