<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationServiceUsedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_service_used', function (Blueprint $table) {
            $table->id();
            $table->string('quot_id');
            $table->integer('service_id');
            $table->decimal('qty');
            $table->decimal('charge');
            $table->decimal('discount');
            $table->decimal('discount_amount');
            $table->decimal('tax');
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
        Schema::dropIfExists('quotation_service_used');
    }
}
