<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAllTablesAddLocationIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('banks', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('currencies', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('customers', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('designations', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('employees', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('salaries', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('expenses', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('expense_heads', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('invoice_details', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('invoice2_details', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('purchases', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('purchase_details', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('product_returns', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('quotations', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('suppliers', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('units', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('sms_settings', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
            $table->foreignId('fiscal_year_id')->nullable()->constrained('fiscal_years', 'id')->onDelete('cascade');
        });
        Schema::table('settings', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('prefix_setting', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('taxes', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('income_heads', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('incomes', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('hardware_setting', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('employee_loan', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('daily_closings', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('service_invoices', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('product_services', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('service_invoice_details', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('attendances', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained('business_locations', 'id')->onDelete('cascade');
        });
        Schema::table('account_heads', function (Blueprint $table) {
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('banks', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('currencies', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('customers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('designations', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('employees', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('salaries', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('expense_heads', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('invoice_details', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('invoice2_details', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('purchase_details', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('product_returns', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('quotations', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('units', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('sms_settings', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
            $table->dropConstrainedForeignId('fiscal_year_id');
        });
        Schema::table('settings', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('prefix_setting', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('taxes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('income_heads', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('incomes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('hardware_setting', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('employee_loan', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('daily_closings', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('service_invoices', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('product_services', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('service_invoice_details', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
        Schema::table('account_heads', function (Blueprint $table) {
            $table->dropConstrainedForeignId('location_id');
        });
    }
}
