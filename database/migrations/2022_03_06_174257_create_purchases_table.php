<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_id')->nullable();
            $table->foreignId('supplier_id')->nullable();
            $table->foreignId('quotation_no')->nullable();
            $table->string('chalan_no')->nullable();
            $table->decimal('grand_total_amount',30,2)->nullable();
            $table->decimal('paid_amount',30,2)->nullable();
            $table->decimal('due_amount',30,2)->nullable();
            $table->decimal('total_discount',30,2)->nullable();
            $table->decimal('net_total_amount',30,2)->nullable();
            $table->date('purchase_date')->nullable();
            $table->text('purchase_details')->nullable();
            $table->integer('status')->nullable();;
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
        Schema::dropIfExists('purchases');
    }
}
