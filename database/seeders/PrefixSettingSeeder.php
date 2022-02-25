<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrefixSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($location = 1)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        if ($location < 2) {
            DB::table('prefix_setting')->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('prefix_setting')->insert([
            [
                'type' => 'TB',
                'full_name' => 'Tentative Booking',
                'prefix' => 'TB',
                'number' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'CR-B',
                'full_name' => 'Event Booking Voucher',
                'prefix' => 'EBV',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'CR-S',
                'full_name' => 'Stage Booking Voucher',
                'prefix' => 'SBV',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'QB',
                'full_name' => 'Event Booking Quotation',
                'prefix' => 'EBQ',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'QS',
                'full_name' => 'Stage Booking Quotation',
                'prefix' => 'SBQ',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'PO',
                'full_name' => 'Purchase Order',
                'prefix' => 'PO',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'Purchase',
                'full_name' => 'Purchase',
                'prefix' => 'PUR',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'INV',
                'full_name' => 'Sale Invoice',
                'prefix' => 'INV',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'Income',
                'full_name' => 'Income',
                'prefix' => 'INC',
                'number' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'Bank Transaction',
                'full_name' => 'Bank Transaction',
                'prefix' => 'BT',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'Expense',
                'full_name' => 'Expense Voucher',
                'prefix' => 'EXP',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'INVT',
                'full_name' => 'Inventory Voucher',
                'prefix' => 'INVT',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'Advance',
                'full_name' => 'Advance Payment Voucher',
                'prefix' => 'APV',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'PR Balance',
                'full_name' => 'Previous Balance Voucher',
                'prefix' => 'PBV',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'Opening',
                'full_name' => 'Opening Balance Voucher',
                'prefix' => 'OBV',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'PM',
                'full_name' => 'Supplier Payment Voucher',
                'prefix' => 'SPV',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'CR',
                'full_name' => 'Customer Receive Voucher',
                'prefix' => 'CRV',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'AD',
                'full_name' => 'Cash Adjustment Voucher',
                'prefix' => 'CAV',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'DV',
                'full_name' => 'Debit Voucher',
                'prefix' => 'DV',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'CV',
                'full_name' => 'Credit Voucher',
                'prefix' => 'CV',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'Contra',
                'full_name' => 'Contra Voucher',
                'prefix' => 'CONTRA',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'JV',
                'full_name' => 'Journal Voucher',
                'prefix' => 'JV',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'Salary',
                'full_name' => 'Salary Voucher',
                'prefix' => 'SV',
                'number' => 1,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'type' => 'Loan',
                'full_name' => 'Loan Request',
                'prefix' => 'LR',
                'number' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
        ]);
    }
}
