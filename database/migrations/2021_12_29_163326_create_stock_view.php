<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStockView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
         CREATE OR REPLACE VIEW stock_view AS
    SELECT
        id, product_id, SUM(quantity) qty, rate
    FROM
        (SELECT
            id, product_id, quantity, rate as rate
        FROM
            purchase_details UNION ALL SELECT
            po_id, product_id, - quantity, po_rate AS rate
        FROM
            invoice2_details) t
    GROUP BY id , product_id , rate
    HAVING SUM(t.quantity) <> 0
");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW stock_view');
    }
}
