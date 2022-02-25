<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatePassMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('gate_pass_menus')) {
            return true;
        }
        Schema::create('gate_pass_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gatepass_id');
            $table->foreignId('product_id');
            $table->foreignId('booking_id');
            $table->decimal('quantity')->nullable();
            $table->string('packing')->nullable();
            $table->string('description')->nullable();
            $table->decimal('total_items')->nullable();
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
        Schema::dropIfExists('gate_passe_menus');
    }
}
