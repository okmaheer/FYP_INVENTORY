<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\DailyClosing;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Reports;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Acc_ReportController extends Controller
{
    public $invoice;
    public $purchase;
    public $transaction;
    public $accountHead;
    public $dailyClosing;
    public $product;
    protected $reportModel;
    private $location;

    public function __construct(Reports $report, Invoice $invoice, Purchase $purchase, Transaction $transaction, AccountHead $accountHead, DailyClosing $dailyClosing,Product $product)
    {
        $this->middleware('auth');
        $this->invoice = $invoice;
        $this->purchase = $purchase;
        $this->transaction = $transaction;
        $this->accountHead = $accountHead;
        $this->dailyClosing = $dailyClosing;
        $this->product = $product;
        $this->reportModel = $report;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }
    public function CashBook(Request $request)
    {
        $this->authorize('cashBook', $this->reportModel);

        $preBalance=0;
        $report = $report2 = [];


        if (count($request->all()) > 0){
            $report = $this->transaction
                ->where('COAID', 'like', '1020101' . '%')
                ->where('location_id', $this->location)
                ->where('IsAppove',1)
                ->where('VDate' , '<', request()->has('start_date')?Carbon::parse(request()->get('start_date'))->format('Y-m-d'):Carbon::today()->toDateString())
                ->selectRaw('SUM(Debit) Debit, SUM(Credit) Credit, IsAppove, COAID')
                ->groupBy('IsAppove', 'COAID');

            $report = \QueryHelper::filterByDate($request,$report,'transaction','transactions');
            $report = $report->get();
            $preBalance = \QueryHelper::getPreviousBalance($request->start_date);


            $report2 = $this->transaction->whereHas('accountHead')
                ->selectRaw('transactions.VNo, transactions.Vtype, transactions.VDate, transactions.Debit, transactions.Credit, transactions.IsAppove, transactions.COAID, transactions.Narration')
                ->groupByRaw('transactions.VNo, transactions.Vtype, transactions.VDate, transactions.Debit, transactions.Credit, transactions.IsAppove, transactions.COAID, transactions.Narration')
                ->havingRaw('SUM(transactions.Debit)-SUM(transactions.Credit)<>0')
                ->where('COAID', 'like', '1020101' . '%')
                ->where('location_id', $this->location);

        $report2 = \QueryHelper::filterByDate($request,$report2,'transaction-between','transactions');
        $report2 = $report2
            ->orderBy('VDate','DESC')
            ->orderBy('VNo','ASC')
            ->get();
        }

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
             'Cash Book' => ''
        ]);

        $page_title = "Cash Book";

        return view('dashboard.accounts.account.Report.cash_book',compact('page_title', 'breadcrumbs','report','report2','preBalance'));
    }
    public function InventoryLedger(Request $request)
    {
        $this->authorize('inventoryLedger', $this->reportModel);

        $preBalance=0;
        $HeadCode = '10107';

        $report = $this->transaction
            ->where('COAID', $HeadCode)
            ->where('IsAppove', 1)
            ->where('location_id', $this->location)
            ->selectRaw('SUM(Debit) Debit, SUM(Credit) Credit, IsAppove, COAID')
            ->groupBy('IsAppove', 'COAID');

        $report = \QueryHelper::filterByDate($request,$report,'transaction','transactions');
        $report = $report->get();

        if(!empty($report) && count($report) > 0){
            $preBalance = $report[0]->Credit - $report[0]->Debit;
        }


        $report2 = $this->transaction->whereHas('accountHead')
            ->selectRaw('transactions.VNo, transactions.Vtype, transactions.VDate, transactions.Debit, transactions.Credit, transactions.IsAppove, transactions.COAID, transactions.Narration')
            ->groupByRaw('transactions.VNo, transactions.Vtype, transactions.VDate, transactions.Debit, transactions.Credit, transactions.IsAppove, transactions.COAID, transactions.Narration')
            ->havingRaw('SUM(transactions.Debit)-SUM(transactions.Credit)<>0')
            ->where('COAID',$HeadCode)
            ->where('location_id', $this->location);

        $report2 = \QueryHelper::filterByDate($request,$report2,'transaction-between','transactions');
        $report2 = $report2->get();

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Inventory Ledger' => ''
        ]);

        $page_title = "Inventory Ledger";

        return view('dashboard.accounts.account.Report.inventory_ledger',compact('page_title', 'breadcrumbs','report','report2','preBalance'));
    }
    public function BankBook()
    {
        $this->authorize('bankBook', $this->reportModel);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
             'Bank Book Report' => ''
        ]);

        $page_title = "Bank Book";

        return view('dashboard.accounts.account.Report.bank_book',compact('page_title', 'breadcrumbs'));
    }
    public function GeneralLedger()
    {
        $this->authorize('generalLedger', $this->reportModel);

        $heads = $this->accountHead
            ->where('IsGL',1)
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->orderByRaw('PHeadName ASC, HeadName ASC')->get();
        $generalLedger = \AccountHelper::generalHeadsDropDown($heads);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'General Ledger' => ''
        ]);

        $page_title = "General Ledger";

        return view('dashboard.accounts.account.Report.general_ledger',compact('page_title', 'breadcrumbs','generalLedger'));
    }

    public function generalLed($id){
        $accountHeadId = $this->accountHead
            ->where('HeadCode',$id)
            ->first();

        $accountHead = $this->accountHead
            ->where('PHeadName',$accountHeadId->HeadName)
            ->where('IsTransaction',1)
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->get();

        $html = "<option value>Transaction Head</option>";

        foreach($accountHead as $data){
            $html .="<option value='$data->HeadCode'>$data->HeadName</option>";
        }
        echo $html;
    }

    public function generalLedgerReport(Request $request){

        $this->authorize('generalLedger', $this->reportModel);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'General Ledger Report' => ''
        ]);

        $page_title = "General Ledger Report";

        $cmbGLCode = $request->cmbGLCode;
        $cmbCode = $request->cmbCode;
        $headName = $this->accountHead->where('HeadCode',$cmbGLCode)->get();
        $headName2 = DB::table('transactions as t')
            ->leftJoin('account_heads as h','h.HeadCode','=','t.COAID')
            ->selectRaw('t.VNo,t.VDate, t.Vtype, t.VDate, t.Narration, t.Debit, t.Credit, t.IsAppove, t.COAID,h.HeadName, h.PHeadName, h.HeadType')
            ->where(['t.IsAppove' => 1,'t.COAID' => $cmbCode])
            ->where('t.VDate', '>=', Carbon::parse($request->start_date)->format('Y-m-d'))
            ->where('t.VDate', '<=',Carbon::parse($request->end_date)->format('Y-m-d'))
            ->where('t.location_id', $this->location)
            ->get();

        $preBalance = $this->transaction
            ->selectRaw('sum(Debit) as predebit, sum(Credit) as precredit')
            ->where(['IsAppove' => 1,'COAID' => $cmbCode])
            ->where('VDate', '<',Carbon::parse($request->start_date)->format('Y-m-d'))
            ->where('location_id', $this->location)
            ->get();

        $preBalance = $preBalance[0]->predebit - $preBalance[0]->precredit;
        $filterDate = [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ];

        return view('dashboard.accounts.account.Report.general_ledger_report',compact('page_title', 'breadcrumbs', 'headName','headName2','preBalance','filterDate'));
    }

    public function GeneralHead()
    {
        $this->authorize('generalHead', $this->reportModel);

        $heads = $this->accountHead
            ->where('IsGL',1)
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->orderByRaw('PHeadName ASC, HeadName ASC')->get();
        $generalLedger = \AccountHelper::generalHeadsDropDown($heads);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
             'General Head Report' => ''
        ]);

        $page_title = "General Head Report";

        return view('dashboard.accounts.account.Report.general_head',compact('page_title', 'breadcrumbs','generalLedger'));
    }

    public function generalHeadReport(Request $request){

        $this->authorize('generalHead', $this->reportModel);

        $page_title = "General Head Report";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'General Head Report' => ''
        ]);

        $cmbGLCode = $request->cmbGLCode;
//        $cmbCode = $request->cmbCode;
        $headName = $this->accountHead->where('HeadCode',$cmbGLCode)->get();
        $headName2 = DB::table('transactions as t')
            ->join('account_heads as h','h.HeadCode','=','t.COAID')
            ->selectRaw('t.VNo,t.VDate, t.Vtype, t.VDate, t.Narration, t.Debit, t.Credit, t.IsAppove, t.COAID,h.HeadName, h.PHeadName, h.HeadType')
            ->where(['t.IsAppove' => 1])
            ->whereIn('h.PHeadName', function($query) use ($cmbGLCode){
                $query->select('HeadName')
                    ->from(with(new AccountHead())->getTable())
                    ->where('HeadCode', $cmbGLCode);
            })
            ->where('t.VDate', '>=',Carbon::parse($request->start_date)->toDateString())
            ->where('t.VDate', '<=',Carbon::parse($request->end_date)->format('Y-m-d'))
            ->where('t.location_id', $this->location)
            ->get();

        $preBalance = $this->transaction
            ->selectRaw('sum(Debit) as predebit, sum(Credit) as precredit')
            ->where(['IsAppove' => 1,'COAID' => $cmbGLCode])
            ->where('VDate', '<',Carbon::parse($request->start_date)->format('Y-m-d'))
            ->where('location_id', $this->location)
            ->get();

        $preBalance = $preBalance[0]->predebit - $preBalance[0]->precredit;
        $filterDate = [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ];

        return view('dashboard.accounts.account.Report.general_head_report',compact('page_title', 'breadcrumbs','headName','headName2','preBalance','filterDate'));
    }

    public function trailBalanceForm()
    {
        $this->authorize('trailBalance', $this->reportModel);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
             'Trail Balance Report' => ''
        ]);

        $page_title = "Trail Balance Report";
        return view('dashboard.accounts.account.Report.trail_balance_form',compact('page_title', 'breadcrumbs'));
    }
    public function trailBalanceReport(Request $request){

        $this->authorize('trailBalance', $this->reportModel);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Trail Balance Report' => ''
        ]);

        $page_title = "Trail Balance Report";

        $oResultTr =  DB::table('account_heads')
            ->where(['IsGL' => 1, 'IsActive' => 1])
            ->whereIn('HeadType',array("A", "L"))
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->orderBy('HeadCode')
            ->get();

        $oResultInEx =  DB::table('account_heads')
            ->where(['IsGL' => 1, 'IsActive' => 1])
            ->whereIn('HeadType',array('I','E'))
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->orderBy('HeadCode')
            ->get();


        $filterDate = [
            'start_date' => Carbon::parse($request->start_date)->format('Y-m-d'),
            'end_date' => Carbon::parse($request->end_date)->format('Y-m-d')
        ];

//        echo "<pre>";
//
//        for($i=0;$i<count($oResultTr);$i++){
//            $COAID = $oResultTr[$i]->HeadCode;
//            $oResultTrial=\QueryHelper::trial_balance_firstquery($filterDate['start_date'],$filterDate['end_date'],$COAID);
//            print_r($oResultTrial[0]->Credit);
//        }
//
//
//        return;


        return view('dashboard.accounts.account.Report.trial_balance_report',compact('page_title', 'breadcrumbs', 'oResultTr','oResultInEx','filterDate'));
    }
    public function profitLossForm()
    {
        $this->authorize('profitLoss', $this->reportModel);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Profit Loss Report' => ''
        ]);

        $page_title = "Profit Loss Report";
        return view('dashboard.accounts.account.Report.profit_loss_form',compact('page_title', 'breadcrumbs'));
    }
    public function profitLossReport(Request $request){
        $this->authorize('profitLoss', $this->reportModel);

        $page_title = "Profit Loss Report";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Profit Loss Report' => ''
        ]);

        $oResultAsset = $this->accountHead->where('HeadType','I')
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->get();
        $oResultLiability = $this->accountHead->where('HeadType','E')->where('HeadCode','<>',402)
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->get();
        $oResultClosingInventory = $this->accountHead->where('HeadName','Inventory')
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->get();

        $date = [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ];


        return view('dashboard.accounts.account.Report.profit_loss_report',compact('page_title', 'breadcrumbs', 'oResultAsset','oResultLiability','oResultClosingInventory','date'));
    }

    public function CashFlow()
    {
        abort(404);
        $this->authorize('cashFlow', $this->reportModel);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Cash Flow Report' => ''
        ]);

        $page_title = "Cash Flow Report";
        return view('dashboard.accounts.account.Report.cash_flow',compact('page_title', 'breadcrumbs'));
    }
    public function CoaPrint()
    {
        $this->authorize('coaPrint', $this->reportModel);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'COA List' => ''
        ]);

        $page_title = "COA List";
        return view('dashboard.accounts.account.Report.coa_print',compact('page_title', 'breadcrumbs'));
    }
    public function BalanceSheet(Request $request)
    {
        $this->authorize('balanceSheet', $this->reportModel);

        $fixed_assets = $this->accountHead->where('PHeadName','Assets')
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->get();
        $liabilities = $this->accountHead->where('PHeadName','Liabilities')
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->get();
        $expenses = $this->accountHead->where('PHeadName','Expense')
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->get();
        $equities = $this->accountHead->where('PHeadName','Equity')
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->get();
        /* just for p&l */
        $oResultAsset = $this->accountHead->where('HeadType','I')
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->get();
        $oResultLiability = $this->accountHead->where('HeadType','E')
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->get();
        $oResultClosingInventory = $this->accountHead->where('HeadName','Inventory')
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->get();


        $start_date = Carbon::now()->format('Y-m-d');
        $end_date = Carbon::now()->format('Y-m-d');

        if($request->has('start_date') && $request->get('start_date') != ''){
            $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        }
        if($request->has('end_date') && $request->get('end_date') != ''){
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d');
        }


        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
             'Balance Sheet' => ''
        ]);

        $page_title = "Balance Sheet";
        return view('dashboard.accounts.account.Report.balancesheet.index',
            compact('page_title', 'breadcrumbs','fixed_assets','liabilities','expenses','equities','oResultLiability','oResultAsset','oResultClosingInventory','start_date','end_date'));
    }


}
