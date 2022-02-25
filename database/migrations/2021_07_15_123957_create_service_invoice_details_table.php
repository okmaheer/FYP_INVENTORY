<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_invoice_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->unique();
            $table->string('service_inv_id');
            $table->decimal('qty');
            $table->decimal('charge');
            $table->decimal('discount');
            $table->decimal('discount_amount');
            $table->decimal('total');
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
        Schema::dropIfExists('service_invoice_details');
    }
}
