<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingStageDecorationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_stage_decorations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->foreignId('stage_id')->nullable();
            $table->foreignId('stage_decoration_id')->nullable();

            $table->decimal('price',30,2)->nullable();
            $table->string('quantity')->nullable();
            $table->decimal('discount',30,2)->nullable();
            $table->decimal('net_total',30,2)->nullable();
            $table->decimal('total',30,2)->nullable();
            $table->text('details')->nullable();
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
        Schema::dropIfExists('booking_stage_decorations');
    }
}
