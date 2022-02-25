<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAllMarqueeTablesAddLocationId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('recipes', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('demands', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('stages', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('booking_quotations', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('stage_quotations', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('event_areas', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('terms_conditions', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('menu', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('seat_plannings', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('add_on_features', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('stage_decorations', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('demands', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('stages', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('booking_quotations', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('stage_quotations', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('event_areas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('terms_conditions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('menu', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('seat_plannings', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('add_on_features', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('stage_decorations', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
    }
}
