<?php

use App\Enum\SessionEnum;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class QueryHelper
{
    /**
     * @param $request
     * @param $query
     * @param null $type
     * @param $table
     * @return mixed
     */
    public static function filterByDate($request, $query, $type = null, $table)
    {
        $commonDateFilter = $request->has('start_date') &&
                            $request->get('start_date') != '' &&
                            $request->has('end_date') &&
                            $request->get('end_date') != '';

        if ($commonDateFilter) {

            if ($type == 'purchase') {
                $query = $query
                    ->where($table . '.purchase_date', '>=', Carbon::parse($request->start_date)->format('Y-m-d'))
                    ->where($table . '.purchase_date', '<=', Carbon::parse($request->end_date)->format('Y-m-d'));

            }
            elseif ($type == 'transaction-between'){
                $query = $query->where($table.'.VDate', '>=', Carbon::parse($request->start_date)->format('Y-m-d'))
                    ->where($table.'.VDate', '<=', Carbon::parse($request->end_date)->format('Y-m-d'));
            }
            elseif ($type == 'transaction'){
                $query = $query->where($table.'.VDate', '<', Carbon::parse($request->start_date)->format('Y-m-d'));
            }
            elseif ($type == 'booking' || $type == 'stage'){
                $query = $query->where($table.'.event_date', '>=', Carbon::parse($request->start_date)->format('Y-m-d'))
                    ->where($table.'.event_date', '<=', Carbon::parse($request->end_date)->format('Y-m-d'));
            }
            elseif ($type == 'invoices') {

                $query = $query
                    ->where($table . '.date', '>=', Carbon::parse($request->start_date)->format('Y-m-d'))
                    ->where($table . '.date', '<=', Carbon::parse($request->end_date)->format('Y-m-d'));

            }
            else {

                $query = $query->where($table.'.date', '>=', Carbon::parse($request->start_date)->format('Y-m-d'))
                    ->where($table.'.date', '<=', Carbon::parse($request->end_date)->format('Y-m-d'));

            }

        }
        return $query;
    }

    public static function supplierFilterByDate($request, $query, $type = null, $table)
    {
        $commonDateFilter = $request->has('start_date') &&
            $request->get('start_date') != '' &&
            $request->has('end_date') &&
            $request->get('end_date') != '';

        if ($commonDateFilter) {

                $query = $query->where($table.'.VDate', '>=', $request->start_date)
                    ->where($table.'.VDate', '<=', $request->end_date);

        }
        elseif ($request->has('supplier_id') &&
            $request->get('supplier_id') != ''){

        }
        return $query;
    }

    public static function dfs($HeadName,$HeadCode,$oResult,$visit,$d)
    {

        if (!empty($HeadCode))
        $balance =  QueryHelper::coa_balance($HeadCode,$HeadName);
        else
            $balance = 0.00 ;
//        return $balance;
        $opening = QueryHelper::opening_coa_balance($HeadCode,$HeadName);
        if($d==0) echo "<li class=\"jstree-open \" data-jstree='{\"icon\":\"text-warning font-20\"}'>$HeadName <a href=/'javascript:void(0)/' class=\"form-control headanchor\"><span class=\"coa_hd\"><b>Head Name</b></span><span class=\"bal_span\"><b>Balance</b></span><span class=\"bal_span\"><b>Opening Balance</b></span></a>";
        else if($d==1) echo "<li  class=\"jstree-open\" data-jstree='{\"icon\":\"text-warning font-20\"}'><a href='javascript:' class=\"form-control jstreelip\">$HeadName <span class=\"bal_span\"> $balance</span><span class=\"bal_span_pre\">$opening</span></a>";
        else echo "<li class=\"jstreeli\" data-jstree='{\"icon\":\"text-warning font-20\"}'><a href='javascript:' class=\"form-control\" onclick=\"loadCoaData('".$HeadCode."')\">$HeadName <span class=\"bal_span\"> $balance</span> <span class=\"bal_span_pre\">$opening</span></a>";
        $p=0;
        for($i=0;$i< count($oResult);$i++)
        {

            if (!$visit[$i])
            {
                if ($HeadName==$oResult[$i]->PHeadName)
                {
                    $visit[$i]=true;
                    if($p==0) echo "<ul>";
                    $p++;
                    QueryHelper::dfs($oResult[$i]->HeadName,$oResult[$i]->HeadCode,$oResult,$visit,$d+1);
                }
            }
        }
        if($p==0)
            echo "</li>";
        else
            echo "</ul>";
    }

    public static function coa_balance($head,$HeadName){
        $head_info = DB::table('account_heads')->select('*')->where('HeadCode',$head)->get();
//        print_r($head_info);
//        return;
        $balance = 0;
        $total_customer_rcv = 0;
        $total_loan_rcv = 0;
        $single_balance = $customer_balance = 0;
        /*all head single(common) balance*/
        $expenseQuery = DB::table('account_heads as parent')
            ->selectRaw('parent.HeadName as parent_head')
            ->join('account_heads as child','child.PHeadName','=','parent.HeadName')
            ->get();

        $query  = DB::table('transactions')
            ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
            ->where('transactions.IsAppove',1)
            ->where('transactions.COAID',$head)
            ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->first();
        $single_bal = $query->predebit - $query->precredit;
        $single_balance += (!empty($single_bal)?$single_bal:0);
        $balance = $single_balance;


        /*single customer receivable balance*/
        if($head_info[0]->PHeadName == 'Customer Receivable'){
            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$head)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();

            $cust_bal = $query->predebit - $query->precredit;
            $customer_balance += (!empty($cust_bal)?$cust_bal:0);


            $balance = $customer_balance;
        }

        /*single loan receivable balance*/
        if($head_info[0]->PHeadName == 'Loan Receivable'){

            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$head)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->get();

            $lnp_bal = $query->predebit - $query->precredit;
            $loanrcv_balance += (!empty($lnp_bal)?$lnp_bal:0);


            $balance = $loanrcv_balance;
        }

        /*total customer receivable balance*/
        if($HeadName == 'Customer Receivable'){
            $coa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Customer Receivable')->get();
            $asset_balance = 0;
            foreach($coa as $assetcoa){

                $query  = DB::table('transactions')
                    ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                    ->where('transactions.IsAppove',1)
                    ->where('transactions.COAID',$assetcoa->HeadCode)
                    ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                    ->first();

                $ass_bal = $query->predebit - $query->precredit;
                $asset_balance += (!empty($ass_bal)?$ass_bal:0);
            }


            $balance = $asset_balance;


        }

        /*total Loan receivable balance*/
        if($HeadName == 'Loan Receivable'){
            $coa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Loan Receivable')->get();
            $asset_balance = 0;
            foreach($coa as $assetcoa){

                $query  = DB::table('transactions')
                    ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                    ->where('transactions.IsAppove',1)
                    ->where('transactions.COAID',$assetcoa->HeadCode)
                    ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                    ->get();

                $ass_bal = $query->predebit - $query->precredit;
                $asset_balance += (!empty($ass_bal)?$ass_bal:0);
            }


            $balance = $asset_balance;
            $total_loan_rcv = $balance;

        }

        /*total cash at bank balance*/
        if($HeadName == 'Cash At Bank'){
            $coa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Cash At Bank')->get();
            $asset_balance = 0;
            foreach($coa as $assetcoa){

                $query  = DB::table('transactions')
                    ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                    ->where('transactions.IsAppove',1)
                    ->where('transactions.COAID',$assetcoa->HeadCode)
                    ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                    ->first();

                $ass_bal = $query->predebit - $query->precredit;
                $asset_balance += (!empty($ass_bal)?$ass_bal:0);
            }


            $balance = $asset_balance;

        }

        /*single bank balance*/

        if($head_info[0]->PHeadName == 'Cash At Bank'){

            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$head)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();
            $bank_balance = 0;
            $bank_bal = $query->predebit - $query->precredit;
            $bank_balance += (!empty($bank_bal)?$bank_bal:0);
            $balance = $bank_balance;

        }

        /*total account receivable*/
        if($HeadName == 'Account Receivable'){
            $coa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Customer Receivable')->get();
            $asset_balance = $loan_balance = 0;
            foreach($coa as $assetcoa){

                $query  = DB::table('transactions')
                    ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                    ->where('transactions.IsAppove',1)
                    ->where('transactions.COAID',$assetcoa->HeadCode)
                    ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                    ->first();

                $ass_bal = $query->predebit - $query->precredit;
                $asset_balance += (!empty($ass_bal)?$ass_bal:0);
            }

            $lncoa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Loan Receivable')->get();
            foreach($lncoa as $lnassetcoa){

                $lnquery  = DB::table('transactions')
                    ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                    ->where('transactions.IsAppove',1)
                    ->where('transactions.COAID',$lnassetcoa->HeadCode)
                    ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                    ->first();
                $ln_bal    = $lnquery->predebit - $lnquery->precredit;
                $loan_balance += (!empty($ln_bal)?$ln_bal:0);
            }

            $single_acc_rcv = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Account Receivable')->get();
            foreach($single_acc_rcv as $singl_rcv){

                $rcvquery  = DB::table('transactions')
                    ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                    ->where('transactions.IsAppove',1)
                    ->where('transactions.COAID',$singl_rcv->HeadCode)
                    ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                    ->first();

                $sreceive_bal = $rcvquery->predebit - $rcvquery->precredit;
                $single_balance += (!empty($sreceive_bal)?$sreceive_bal:0);
            }



            $balance = $asset_balance + $loan_balance + $single_balance;

        }

        if($HeadName == 'Cash & Cash Equivalent'){
            $bank_balance = 0;
            $cash_balance = 0;
            $coa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Cash At Bank')->get();
            foreach($coa as $assetcoa){

                $query  = DB::table('transactions')
                    ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                    ->where('transactions.IsAppove',1)
                    ->where('transactions.COAID',$assetcoa->HeadCode)
                    ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                    ->first();

                $bank_bal = $query->predebit - $query->precredit;
                $bank_balance += (!empty($bank_bal)?$bank_bal:0);
            }

            $cash_other = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Cash & Cash Equivalent')->get();
            foreach($cash_other as $cashother){

                $query  = DB::table('transactions')
                    ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                    ->where('transactions.IsAppove',1)
                    ->where('transactions.COAID',$cashother->HeadCode)
                    ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                    ->first();

                $cash_bal = $query->predebit - $query->precredit;
                $cash_balance += (!empty($cash_bal)?$cash_bal:0);
            }

            $balance = $bank_balance + $cash_balance;

        }

        if($HeadName == 'Current Asset'){

            $balance = QueryHelper::total_current_asset_balance();

        }

        if($HeadName == 'Non Current Assets'){

            $balance = QueryHelper::total_non_current_asset_balance();

        }
        if($HeadName == 'Assets'){
            $cur_balance      = QueryHelper::total_current_asset_balance();
            $non_cure_balance = QueryHelper::total_non_current_asset_balance();
            $balance          = $cur_balance + $non_cure_balance;

        }

        if($HeadName == 'Equity'){
            $balance = QueryHelper::total_equity_balance();
        }



        foreach ($expenseQuery as $eq){

            if($HeadName == 'Expense'){
                $balance = QueryHelper::total_expense_balance();
            }
            if($HeadName == $eq->parent_head && $HeadName != 'Assets' && $HeadName != 'Non Current Assets' && $HeadName != 'Current Asset' && $HeadName != 'Account Receivable'){
                $balance = QueryHelper::total_expense_balance_parent($eq->parent_head);
            }

        }

        if($HeadName == 'Income'){
            $balance = QueryHelper::total_income_balance();
        }
        if($HeadName == 'Account Payable'){
            $balance = QueryHelper::total_acc_payable_balance();
        }
        if($HeadName == 'Employee Ledger'){
            $balance = QueryHelper::total_acc_employee_balance();
        }
        if($HeadName == 'Current Liabilities'){
            $balance_ac_payable = QueryHelper::total_acc_payable_balance();
            $emp_payable        = QueryHelper::total_acc_employee_balance();
            $rootcur_liablities = QueryHelper::total_acc_cruliabilities_balance();
            $balance            = $balance_ac_payable + $emp_payable + $rootcur_liablities;
        }

        if($HeadName == 'Non Current Liabilities'){
            $balance = QueryHelper::total_acc_no_curliability_balance();
        }

        if($HeadName == 'Liabilities'){
            $non_cur_balance    = QueryHelper::total_acc_no_curliability_balance();
            $balance_ac_payable = QueryHelper::total_acc_payable_balance();
            $emp_payable        = QueryHelper::total_acc_employee_balance();
            $rootcur_liablities = QueryHelper::total_acc_cruliabilities_balance();
            $balance            = $balance_ac_payable + $emp_payable + $rootcur_liablities + $non_cur_balance;
        }

        return (!empty($balance)?number_format($balance,2):number_format(0,2));
    }

    public static function opening_coa_balance($head,$HeadName){

        $query  = DB::table('transactions')
            ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
            ->where('transactions.IsAppove',1)
            ->where('transactions.COAID',$head)
            ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->first();


        $expenseQuery = DB::table('account_heads as parent')
            ->selectRaw('parent.HeadName as parent_head')
            ->join('account_heads as child','child.PHeadName','=','parent.HeadName')
            ->get();


        $ass_bal = $query->predebit - $query->precredit;
        $balance = $ass_bal;
        if($HeadName == 'Customer Receivable'){
            $balance = QueryHelper::customer_rec_opening();
        }
        if($HeadName == 'Loan Receivable'){
            $balance          = QueryHelper::loan_rec_opening();
        }
        if($HeadName == 'Account Receivable'){
            $root_balance     = QueryHelper::account_rec_opening();
            $customer_balance = QueryHelper::customer_rec_opening();
            $loan_balance     = QueryHelper::loan_rec_opening();
            $balance          = $root_balance + $customer_balance + $loan_balance;
        }
        if($HeadName == 'Cash At Bank'){
            $balance = QueryHelper::bank_opening();
        }
        if($HeadName == 'Cash & Cash Equivalent'){
            $balance = QueryHelper::cash_equivalent_opening();
        }
        if($HeadName == 'Current Asset'){
            $cash_equivalent_balance = QueryHelper::cash_equivalent_opening();
            $root_balance            = QueryHelper::account_rec_opening();
            $customer_balance        = QueryHelper::customer_rec_opening();
            $loan_balance            = QueryHelper::loan_rec_opening();
            $balance                 = $root_balance + $customer_balance + $loan_balance + $cash_equivalent_balance;
        }

        if($HeadName == 'Non Current Assets'){
            $balance = QueryHelper::non_current_ass_opening();
        }
        if($HeadName == 'Assets'){
            $non_curopen = QueryHelper::non_current_ass_opening();
            $cash_equivalent_balance = QueryHelper::cash_equivalent_opening();
            $root_balance            = QueryHelper::account_rec_opening();
            $customer_balance        = QueryHelper::customer_rec_opening();
            $loan_balance            = QueryHelper::loan_rec_opening();
            $balance                 = $root_balance + $customer_balance + $loan_balance + $cash_equivalent_balance + $non_curopen;
        }

        if($HeadName == 'Equity'){
            $balance = QueryHelper::equity_opening();
        }



        foreach ($expenseQuery as $eq){


            if($HeadName == 'Expense'){
                $balance = QueryHelper::expense_opening();
            }
            if($HeadName == $eq->parent_head && $HeadName != 'Assets' && $HeadName != 'Non Current Assets' && $HeadName != 'Current Asset' && $HeadName != 'Account Receivable'){
                $balance = QueryHelper::expense_parent_heads($eq->parent_head);
            }

        }


        if($HeadName == 'Income'){
            $balance = QueryHelper::income_opening();
        }
        if($HeadName == 'Account Payable'){
            $balance = QueryHelper::acc_payable_opening();
        }

        if($HeadName == 'Employee Ledger'){
            $balance = QueryHelper::acc_employeeledger_opening();
        }

        if($HeadName == 'Current Liabilities'){
            $cur_balance     = QueryHelper::acc_curliabilities_opening();
            $paya_balance    = QueryHelper::acc_payable_opening();
            $employe_balance = QueryHelper::acc_employeeledger_opening();
            $balance         = $cur_balance + $paya_balance + $employe_balance;
        }

        if($HeadName == 'Non Current Liabilities'){
            $balance = QueryHelper::acc_non_curliabilities_opening();
        }

        if($HeadName == 'Liabilities'){
            $non_balance     = QueryHelper::acc_non_curliabilities_opening();
            $cur_balance     = QueryHelper::acc_curliabilities_opening();
            $paya_balance    = QueryHelper::acc_payable_opening();
            $employe_balance = QueryHelper::acc_employeeledger_opening();
            $balance         = $cur_balance + $paya_balance + $employe_balance + $non_balance;
        }



        return (!empty($balance)?number_format($balance,2):number_format(0,2));
    }

    public static function total_current_asset_balance(){
        $asset_balance = $loan_balance = $single_balance = 0;
        $coa           = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Customer Receivable')->get();
        $asset_balance = 0;
        foreach($coa as $assetcoa){
            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();

            $ass_bal = $query->predebit - $query->precredit;
            $asset_balance += (!empty($ass_bal)?$ass_bal:0);
        }

        $lncoa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Loan Receivable')->get();
        foreach($lncoa as $lnassetcoa){

            $lnquery  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$lnassetcoa['HeadCode'])
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->get();
            $ln_bal    = $lnquery->predebit - $lnquery->precredit;
            $loan_balance += (!empty($ln_bal)?$ln_bal:0);
        }

        $single_acc_rcv = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Account Receivable')->get();
        foreach($single_acc_rcv as $singl_rcv){

            $rcvquery  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$singl_rcv->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();
            $sreceive_bal = $rcvquery->predebit - $rcvquery->precredit;
            $single_balance += (!empty($sreceive_bal)?$sreceive_bal:0);
        }



        $bank_balance = 0;
        $cash_balance = 0;
        $coa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Cash At Bank')->get();
        foreach($coa as $assetcoa){

            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();

            $bank_bal = $query->predebit - $query->precredit;
            $bank_balance += (!empty($bank_bal)?$bank_bal:0);
        }

        $cash_other = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Cash & Cash Equivalent')->get();
        foreach($cash_other as $cashother){

            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$cashother->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();

            $cash_bal = $query->predebit - $query->precredit;
            $cash_balance += (!empty($cash_bal)?$cash_bal:0);
        }

        $balance = $bank_balance + $cash_balance;
        return $balance = $asset_balance + $loan_balance + $single_balance + $bank_balance + $cash_balance;



    }

    public static function total_non_current_asset_balance(){
        $total = 0;
        $coa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Non Current Assets')->get();
        foreach($coa as $assetcoa){

            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();

            $balance = $query->predebit - $query->precredit;
            $total += (!empty($balance)?$balance:0);
        }
        return $total;
    }

    public static function total_equity_balance(){
        $total = 0;
        $coa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Equity')->get();
        foreach($coa as $assetcoa){

            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();

            $balance = $query->predebit - $query->precredit;
            $total += (!empty($balance)?$balance:0);
        }
        return $total;
    }

    public static function total_expense_balance(){
        $total = 0;
        $first = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Expense');
        $coa = DB::table('account_heads as parent')
            ->selectRaw('child.HeadCode as HeadCode')
            ->join('account_heads as child','child.PHeadName','=','parent.HeadName')
            ->where('parent.PHeadName','Expense')
            ->union($first)
            ->get();

        foreach($coa as $assetcoa){

            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();
            $balance = $query->predebit - $query->precredit;
            $total += (!empty($balance)?$balance:0);
        }
        return $total;
    }

    public static function total_expense_balance_parent($parentHeadName){
        $total = 0;
        $first = DB::table('account_heads')->select('HeadCode')->where('PHeadName',$parentHeadName);
        $coa = DB::table('account_heads as parent')
            ->selectRaw('child.HeadCode as HeadCode')
            ->leftjoin('account_heads as child','child.PHeadName','=','parent.HeadName')
            ->where('parent.PHeadName',$parentHeadName)
            ->union($first)
            ->get();

        foreach($coa as $assetcoa){

            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();
            $balance = $query->predebit - $query->precredit;
            $total += (!empty($balance)?$balance:0);
        }
        return $total;
    }

    public static function total_income_balance(){
        $total = 0;
        $coa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Income')->get();
        foreach($coa as $assetcoa){

            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();

            $balance = $query->predebit - $query->precredit;
            $total += (!empty($balance)?$balance:0);
        }
        return $total;
    }

    public static function total_acc_payable_balance(){
        $total = 0;
        $coa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Account Payable')->get();
        foreach($coa as $assetcoa){

            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();

            $balance = $query->predebit - $query->precredit;
            $total += (!empty($balance)?$balance:0);
        }
        return $total;
    }

    public static function total_acc_employee_balance(){
        $total = 0;
        $coa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Employee Ledger')->get();
        foreach($coa as $assetcoa){

            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();
            $balance = $query->predebit - $query->precredit;
            $total += (!empty($balance)?$balance:0);
        }
        return $total;
    }

    public static function total_acc_cruliabilities_balance(){
        $total = 0;
        $coa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Current Liabilities')->get();
        foreach($coa as $assetcoa){

            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();
            $balance = $query->predebit - $query->precredit;
            $total += (!empty($balance)?$balance:0);
        }
        return $total;
    }

    public static function total_acc_no_curliability_balance(){
        $total = 0;
        $coa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Non Current Liabilities')->get();
        foreach($coa as $assetcoa){

            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();

            $balance = $query->predebit - $query->precredit;
            $total += (!empty($balance)?$balance:0);
        }
        return $total;
    }


    public static function customer_rec_opening(){
        $total = 0;
        $coa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Loan Receivable')->get();
        foreach($coa as $assetcoa){

            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();

            $cust_bal = $query->predebit - $query->precredit;
            $total += $cust_bal;
        }
        return $total;
    }

    public static function loan_rec_opening(){
        $total = 0;
        $coa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Customer Receivable')->get();
        foreach($coa as $assetcoa){
            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();

            $cust_bal = $query->predebit - $query->precredit;
            $total += $cust_bal;
        }
        return $total;
    }
    public static function account_rec_opening(){
        $total = 0;
        $coa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Account Receivable')->get();
        foreach($coa as $assetcoa){
            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();
            $cust_bal = $query->predebit - $query->precredit;
            $total += $cust_bal;
        }
        return $total;
    }

    public static function bank_opening(){
        $total = 0;
        $coa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Cash At Bank')->get();
        foreach($coa as $assetcoa){
            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();
            $cust_bal = $query->predebit - $query->precredit;
            $total += $cust_bal;
        }
        return $total;
    }

    public static function cash_equivalent_opening(){
        $total = 0;
        $coa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Cash & Cash Equivalent')->get();
        foreach($coa as $assetcoa){
            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();
            $cust_bal = $query->predebit - $query->precredit;
            $total += $cust_bal;
        }
        return $total;
    }

    public static function non_current_ass_opening(){
        $total = 0;
        $coa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Non Current Assets')->get();
        foreach($coa as $assetcoa){
            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();
            $cust_bal = $query->predebit - $query->precredit;
            $total += $cust_bal;
        }
        return $total;
    }

    public static function equity_opening(){
        $total = 0;
        $coa = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Equity')->get();
        foreach($coa as $assetcoa){
            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();
            $cust_bal = $query->predebit - $query->precredit;
            $total += $cust_bal;
        }
        return $total;
    }

    public static function expense_opening(){
        $total = 0;
//        $coa   = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Expense')->get();

        $first   = DB::table('account_heads')
            ->select('HeadName','HeadCode')
            ->whereIn('PHeadName', function($query){
            $query->select('HeadName')
                ->from(with(new \App\Models\AccountHead())->getTable())
                ->where('PHeadName', 'Expense');
        });
        $coa = DB::table('account_heads')->select('HeadName','HeadCode')
            ->where('PHeadName','Expense')
            ->union($first)
            ->get();

        foreach($coa as $assetcoa){
            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();
            $cust_bal = $query->predebit - $query->precredit;
            $total += $cust_bal;
        }
        return $total;
    }
    public static function expense_parent_heads($parentHeadName){
        $total = 0;
        $coa   = DB::table('account_heads')->select('HeadCode')->where('PHeadName',$parentHeadName)->get();
        foreach($coa as $assetcoa){
            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();
            $cust_bal = $query->predebit - $query->precredit;
            $total += $cust_bal;
        }
        return $total;
    }

    public static function income_opening(){
        $total = 0;
        $coa   = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Income')->get();
        foreach($coa as $assetcoa){
            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();
            $cust_bal = $query->predebit - $query->precredit;
            $total += $cust_bal;
        }
        return $total;
    }
    public static function acc_payable_opening(){
        $total = 0;
        $coa   = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Account Payable')->get();
        foreach($coa as $assetcoa){
            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();
            $cust_bal = $query->predebit - $query->precredit;
            $total += $cust_bal;
        }
        return $total;
    }

    public static function acc_employeeledger_opening(){
        $total = 0;
        $coa  = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Employee Ledger')->get();
        foreach($coa as $assetcoa){
            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();
            $cust_bal = $query->predebit - $query->precredit;
            $total += $cust_bal;
        }
        return $total;
    }

    public static function acc_curliabilities_opening(){
        $total = 0;
        $coa   = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Current Liabilities')->get();
        foreach($coa as $assetcoa){
            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();
            $cust_bal = $query->predebit - $query->precredit;
            $total += $cust_bal;
        }
        return $total;
    }

    public static function acc_non_curliabilities_opening(){
        $total = 0;
        $coa   = DB::table('account_heads')->select('HeadCode')->where('PHeadName','Non Current Liabilities')->get();
        foreach($coa as $assetcoa){
            $query  = DB::table('transactions')
                ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                ->where('transactions.IsAppove',1)
                ->where('transactions.COAID',$assetcoa->HeadCode)
                ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->first();
            $cust_bal = $query->predebit - $query->precredit;
            $total += $cust_bal;
        }
        return $total;
    }

    public static function assets_info($head_name){
        $query = DB::table('account_heads')
            ->select("*")
            ->where('PHeadName',$head_name)
            ->get()->groupBy('HeadCode');
        return $query;
    }

    public static function assets_balance($head_code,$from_date,$to_date){
        $query  = DB::table('transactions')
            ->selectRaw('(sum(Debit)-sum(Credit)) as balance')
            ->where('COAID',$head_code)
//            ->where('VDate', '>=', $from_date)
            ->where('VDate', '<=', $to_date)
            ->where('IsAppove',1)
            ->where('location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->first();
        return $query;

    }

    public static function asset_childs($head_name,$from_date,$to_date){
        $query = DB::table('account_heads')
            ->where('PHeadName',$head_name)
            ->get()->groupBy('HeadCode');
        return $query;
    }

    public static function asset_non_cur_childs($head_name,$from_date,$to_date){
        $query = DB::table('account_heads')
            ->where('HeadName',$head_name)
            ->get()->groupBy('HeadCode');
        return $query;
    }

    public static function liabilities_info($head_name){

        $query = DB::table('account_heads')
            ->where('PHeadName',$head_name)
            ->get();
        return $query;
    }

    public static function liabilities_info_tax($head_name){

        $query = DB::table('account_heads')
            ->where('HeadName',$head_name)
            ->get();
        return $query;

    }

    public static function liabilities_balance($head_code,$from_date,$to_date){

        $query  = DB::table('transactions')
            ->selectRaw('(sum(Credit)-sum(Debit)) as balance,COAID')
            ->where('COAID',$head_code)
            ->where('VDate', '>=', $from_date)
            ->where('VDate', '<=', $to_date)
            ->where('IsAppove',1)
            ->where('location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->groupBy('COAID')
            ->first();
        return $query;

    }

    public static function income_balance($head_code,$from_date,$to_date){
        $query  = DB::table('transactions')
            ->selectRaw('(sum(Debit)-sum(Credit)) as balance,COAID')
            ->where('COAID',$head_code)
            ->where('VDate', '>=', $from_date)
            ->where('VDate', '<=', $to_date)
            ->where('IsAppove',1)
            ->where('location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->groupBy('COAID')
            ->first();
        return $query;

    }

    public static function income_childs_balance($head_name,$from_date,$to_date){

        $query = DB::table('transactions')
            ->selectRaw('SUM(transactions.Debit) - SUM(transactions.Credit) as balance')
            ->join('account_heads as h','h.HeadCode','=','transactions.COAID')
            ->where('h.PHeadName', $head_name)
            ->orWhere('h.HeadName', $head_name)
            ->where('transactions.VDate', '>=', Carbon::parse($from_date)->format('Y-m-d'))
            ->where('transactions.VDate', '<=', Carbon::parse($to_date)->format('Y-m-d'))
            ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->first();

        return $query;
    }

    public static function equity_info($head_name,$from_date,$to_date){
        $query = DB::table('account_heads')
            ->where('HeadName',$head_name)
            ->get()->groupBy('HeadCode');
        return $query;
    }

    public static function equity_balance($head_code,$from_date,$to_date){

        $query  = DB::table('transactions')
            ->selectRaw('(sum(Debit)-sum(Credit)) as balance,COAID')
            ->where('COAID',$head_code)
            ->where('VDate', '>=', $from_date)
            ->where('VDate', '<=', $to_date)
            ->where('IsAppove',1)
            ->where('location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->groupBy('COAID')
            ->first();
        return $query;

    }

    public static  function profitloss_firstquery($dtpFromDate,$dtpToDate,$COAID){
        $sql = DB::table('transactions')
            ->selectRaw('SUM(transactions.Debit) - SUM(transactions.Credit) AS Amount')
            ->join('account_heads as h','h.HeadCode','=','transactions.COAID')
            ->where('transactions.COAID', 'like', $COAID . '%')
            ->where('transactions.VDate', '>=', Carbon::parse($dtpFromDate)->format('Y-m-d'))
            ->where('transactions.VDate', '<=', Carbon::parse($dtpToDate)->format('Y-m-d'))
            ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->get();


        return $sql;

    }

    public static  function profitloss_secondquery($dtpFromDate,$dtpToDate,$COAID){
        $sql = DB::table('transactions')
            ->selectRaw('SUM(transactions.Debit) - SUM(transactions.Credit) AS Amount')
            ->join('account_heads as h','h.HeadCode','=','transactions.COAID')
            ->where('transactions.COAID', 'like', $COAID . '%')
            ->where('transactions.VDate', '>=', Carbon::parse($dtpFromDate)->format('Y-m-d'))
            ->where('transactions.VDate', '<=', Carbon::parse($dtpToDate)->format('Y-m-d'))
            ->where('transactions.IsAppove', '=', 1)
            ->where('transactions.location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->get();


        return $sql;

    }

    public static function AssertCoa($HeadName,$HeadCode,$GL,$oResultAsset,$Visited,$value,$dtpFromDate,$dtpToDate,$check){


        if($value==1)
        {
            echo "<tr>
                <td colspan='2' class='font-weight-bold' style='color: #5766da !important; background-color: rgba(87, 102, 218, 0.15) !important;'><h4 class='mt-0 mb-0'>". $HeadName."</h4></td>
            </tr>";

        }
        elseif($value>1)
        {

            $COAID=$HeadCode;
            if($check)
            {
                $sqlF=QueryHelper::profitloss_firstquery($dtpFromDate,$dtpToDate,$COAID);
            }
            else
            {
                $sqlF= QueryHelper::profitloss_secondquery($dtpFromDate,$dtpToDate,$COAID);
            }

            $oResultAmountPreF = $sqlF;

            if($value==2)
            {
                if($check==1)
                {
                    $GLOBALS['TotalLiabilityF']=$GLOBALS['TotalLiabilityF']+$oResultAmountPreF[0]->Amount;
                }
                else
                {
                    $GLOBALS['TotalAssertF']=$GLOBALS['TotalAssertF']+$oResultAmountPreF[0]->Amount;
                }
            }

            if($oResultAmountPreF[0]->Amount!=0)
            {
              echo "<tr>
                <td align='left'><h5 class='mt-0 mb-0'>". $HeadName ."</h5></td>
                <td align='right'><h5 class='mt-0 mb-0'>". \AccountHelper::number_format( $oResultAmountPreF[0]->Amount ) ."</h5></td>
            </tr>";

            }
        }
        for($i=0;$i<count($oResultAsset);$i++)
        {
            if (!$Visited[$i]&&$GL==0)
            {
                if ($HeadName==$oResultAsset[$i]->PHeadName)
                {
                    $Visited[$i]=true;
                    QueryHelper::AssertCoa($oResultAsset[$i]->HeadName,$oResultAsset[$i]->HeadCode,$oResultAsset[$i]->IsGL,$oResultAsset,$Visited,$value+1,$dtpFromDate,$dtpToDate,$check);
                }
            }
        }
    }


    public static function AssertCoaWithoutHtml($HeadName,$HeadCode,$GL,$oResultAsset,$Visited,$value,$dtpFromDate,$dtpToDate,$check){



        if($value>1)
        {

            $COAID=$HeadCode;
            if($check)
            {
                $sqlF=QueryHelper::profitloss_firstquery($dtpFromDate,$dtpToDate,$COAID);
            }
            else
            {
                $sqlF= QueryHelper::profitloss_secondquery($dtpFromDate,$dtpToDate,$COAID);
            }

            $oResultAmountPreF = $sqlF;

            if($value==2)
            {
                if($check==1)
                {
                    $GLOBALS['TotalLiabilityF']=$GLOBALS['TotalLiabilityF']+$oResultAmountPreF[0]->Amount;
                }
                else
                {
                    $GLOBALS['TotalAssertF']=$GLOBALS['TotalAssertF']+$oResultAmountPreF[0]->Amount;
                }
            }

        }
        for($i=0;$i<count($oResultAsset);$i++)
        {
            if (!$Visited[$i]&&$GL==0)
            {
                if ($HeadName==$oResultAsset[$i]->PHeadName)
                {
                    $Visited[$i]=true;
                    QueryHelper::AssertCoaWithoutHtml($oResultAsset[$i]->HeadName,$oResultAsset[$i]->HeadCode,$oResultAsset[$i]->IsGL,$oResultAsset,$Visited,$value+1,$dtpFromDate,$dtpToDate,$check);
                }
            }
        }
    }

    public static function trial_balance_firstquery($dtpFromDate,$dtpToDate,$COAID){
        $sql = DB::table('transactions')
            ->selectRaw('SUM(transactions.Debit) AS Debit, SUM(transactions.Credit) AS Credit')
            ->where('COAID', 'like', $COAID . '%')
            ->where('VDate', '>=', $dtpFromDate)
            ->where('VDate', '<=', $dtpToDate)
            ->where('IsAppove', 1)
            ->where('location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->get();

        return $sql;
    }


    public static function trial_balance_secondquery($dtpFromDate,$dtpToDate,$COAID){
        $sql = DB::table('transactions')
            ->selectRaw('SUM(transactions.Debit) AS Debit, SUM(transactions.Credit) AS Credit')
            ->where('COAID', 'like', $COAID . '%')
            ->where('VDate', '>=', $dtpFromDate)
            ->where('VDate', '<=', $dtpToDate)
            ->where('IsAppove', 1)
            ->where('location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->get();

        return $sql;
    }

    public static function getPreviousBalance($dtpFromDate){
        $balance = 0 ;
        $dtpFromDate = new DateTime($dtpFromDate);
//        $dtpToDate = new DateTime($dtpToDate);
//        $interval = $dtpFromDate->diff($dtpToDate);
//        $days = $interval->format('%a');
//        $days = ($days==0) ? 1: $days +1;
//        $days = 1;
//        $previousFromDate = \Carbon\Carbon::parse($dtpFromDate)->subDays($days)->format('Y-m-d');
//        $previousToDate = \Carbon\Carbon::parse($dtpToDate)->subDays($days)->format('Y-m-d');

        $report = DB::table('transactions')
            ->where('COAID', 'like', '1020101' . '%')
            ->where('IsAppove',1)
            ->where('location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->selectRaw('SUM(Debit) Debit, SUM(Credit) Credit, IsAppove, COAID')
            ->groupBy('IsAppove', 'COAID');
        $report = $report->where('VDate', '<', $dtpFromDate);

        $report = $report->get();

        if(!empty($report) && count($report) > 0)
            $balance = $report[0]->Debit - $report[0]->Credit;


        return $balance;
    }

    public static function supplier_wise(){


        return 0;
    }

    public static function po_wise_stock($qty,$product_id){
        $qeury = DB::select("select id,product_id,qty,rate,issue_qty,sumqty,issue_stock split_quantity
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
select  t.id,t.product_id,t.qty,t.rate,$qty issue_qty, sum(qty) over (PARTITION BY product_id order by id) sumqty from stock_view  t   ) t2 ) t3 ) t4 )t5
where sum_is_stk<=issue_qty and product_id=$product_id");

        return $qeury;
    }

    public static function costOfGoodsSold($dtpFromDate,$dtpToDate){
        $oInv = DB::table('transactions')
            ->where('COAID', 'like', '10107' . '%')
            ->where('IsAppove',1)
            ->where('location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->selectRaw('SUM(transactions.Debit) - SUM(transactions.Credit) AS opening_inv');
        $oInv = $oInv->where('VDate', '<', Carbon::parse($dtpFromDate)->format('Y-m-d'));

        $oInv = $oInv->first();


        $productPurchase = DB::table('transactions')
            ->where('COAID', 'like', '402' . '%')
            ->where('IsAppove',1)
            ->where('location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->selectRaw('SUM(transactions.Debit) AS total_purchase')
            ->where('VDate', '>=', Carbon::parse($dtpFromDate)->format('Y-m-d'))
            ->where('VDate', '<=', Carbon::parse($dtpToDate)->format('Y-m-d'));

        $productPurchase = $productPurchase->first();


        $cInv = DB::table('transactions')
            ->where('COAID', 'like', '10107' . '%')
            ->where('IsAppove',1)
            ->where('location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->selectRaw('SUM(transactions.Debit) - SUM(transactions.Credit) AS closing_inv');
        $cInv = $cInv->where('VDate', '<=', Carbon::parse($dtpToDate)->format('Y-m-d'));

        $cInv = $cInv->first();


        $totalCOGS= $oInv->opening_inv + $productPurchase->total_purchase - $cInv->closing_inv ;


///////////// for Gross Profit ////////////////////

        $productSale = DB::table('transactions')
            ->where('COAID', 'like', '303' . '%')
            ->where('IsAppove',1)
            ->where('location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->selectRaw('SUM(transactions.Debit) AS total_sale')
            ->where('VDate', '>=', Carbon::parse($dtpFromDate)->format('Y-m-d'))
            ->where('VDate', '<=', Carbon::parse($dtpToDate)->format('Y-m-d'));

        $productSale = $productSale->first();

        $gProfit = $productSale->total_sale - $totalCOGS;


        $data = [
            'totalCOGS' => $totalCOGS,
            'gProfit'   => $gProfit
        ];

        return $data;

    }
}
