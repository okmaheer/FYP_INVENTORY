<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_heads', function (Blueprint $table) {

            $table->id();
            $table->foreignId('HeadCode');
            $table->string('HeadName');
            $table->string('PHeadName');
            $table->integer('HeadLevel');
            $table->tinyInteger('IsActive')->nullable();
            $table->tinyInteger('IsTransaction')->nullable();
            $table->tinyInteger('IsGL')->nullable();
            $table->string('HeadType')->nullable();
            $table->tinyInteger('IsBudget')->nullable();
            $table->tinyInteger('IsDepreciation')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->foreignId('supplier_id')->nullable();
            $table->foreignId('pettycash_id')->nullable();
            $table->foreignId('service_id')->nullable();
            $table->foreignId('employee_id')->nullable();
            $table->decimal('DepreciationRate')->nullable();
            $table->string('created_by')->nullable();
            $table->string('UpdateBy')->nullable();
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
        Schema::dropIfExists('account_heads');
    }

}
