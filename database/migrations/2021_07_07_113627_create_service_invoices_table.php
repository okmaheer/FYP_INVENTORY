<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_no');
            $table->date('date');
            $table->string('employee_id')->nullable();
            $table->foreignId('customer_id')->unique()->nullable();
            $table->decimal('total_amount');
            $table->decimal('total_discount');
            $table->decimal('invoice_discount');
            $table->decimal('total_tax');
            $table->decimal('paid_amount');
            $table->decimal('due_amount');
            $table->decimal('shipping_cost');
            $table->decimal('previous');
            $table->string('details');
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
        Schema::dropIfExists('service_invoices');
    }
}
