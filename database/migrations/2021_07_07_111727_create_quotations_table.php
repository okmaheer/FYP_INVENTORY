<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId ('customer_id')->nullable();
            $table->string('address')->nullable();
            $table->date('qdate')->nullable();
            $table->string('mobile')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('details')->nullable();
            $table->string('product_name')->nullable();
            $table->string('desc')->nullable();
            $table->string('available_quantity')->nullable();
            $table->string('product_quantity')->nullable();
            $table->integer('product_rate')->nullable();
            $table->string('discount')->nullable();
            $table->string('total_price')->nullable();
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
        Schema::dropIfExists('quotations');
    }
}
