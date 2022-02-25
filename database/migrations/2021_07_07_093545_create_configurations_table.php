<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable
 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->text('protocol');
            $table->text('smtp_host');
            $table->text('smtp_port');
            $table->string('smtp_user');
            $table->string('smtp_pass');
            $table->string('mailtype')->nullable();
            $table->tinyInteger('isinvoice');
            $table->tinyInteger('isservice');
            $table->tinyInteger('isquotation');
            $table->enum('type',['email'])->default('email');
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
        Schema::dropIfExists('configurations');
    }
}
