<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->string('invoice_no')->nullable();
            $table->date('date')->nullable();
            $table->decimal('net_total',30,2)->nullable();
            $table->decimal('paid_amount',30,2)->nullable();
            $table->decimal('grand_total_price',30,2)->nullable();
            $table->decimal('due_amount',30,2)->nullable();
            $table->decimal('previous_due',30,2)->nullable();
            $table->decimal('shipping_cost',30,2)->nullable();
            $table->bigInteger('offline_invoice_no')->nullable();
            $table->decimal('invoice_discount',30,2)->nullable();
            $table->decimal('total_discount',30,2)->nullable();
            $table->foreignId('tax_id')->nullable();
            $table->decimal('total_tax',30,2)->nullable();
            $table->integer('status')->nullable();
            $table->integer('payment_type')->nullable();
            $table->text('invoice_details')->nullable();
            $table->integer('is_online')->nullable();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
