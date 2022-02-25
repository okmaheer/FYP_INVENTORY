<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateGetStockPoWiseView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE OR REPLACE VIEW stock_po_view AS
select id,product_id,qty,rate,issue_qty,sumqty,issue_stock split_quantity
from(
select id,product_id,qty,rate,issue_qty,sumqty,issue_stock,sum(issue_stock) over (partition by product_id order by id) sum_is_stk
from (
select id,product_id,qty,rate,issue_qty,sumqty,balance,final_balance,
case when sumqty=
 sum(final_balance) over (partition by product_id order by id)  then
 final_balance else
 issue_qty-sum(final_balance) over (partition by product_id order by id) end  issue_stock
 from(
select id,product_id,qty,rate,issue_qty,sumqty ,sumqty-issue_qty balance,
case when sumqty-issue_qty<0 then qty  else 0
 end  final_balance
from (
select  t.id,t.product_id,t.qty,t.rate,150 issue_qty, sum(qty) over (PARTITION BY product_id order by id) sumqty from stock_view  t   ) t2 ) t3 ) t4 )t5
where sum_is_stk<=issue_qty');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW stock_po_view');
    }
}
