<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\Accounts;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Transaction;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Illuminate\Support\Facades\Auth;
use App\Models\Prefixes;

class AccountController extends Controller
{
    public $supplier;
    public $customer;
    public $accountHead;
    public $transaction;
    protected $accountsModel;
    private $location;

    public function __construct(Accounts $accounts, Supplier $supplier,Customer $customer,AccountHead $accountHead,Transaction $transaction){
        $this->middleware('auth');
        $this->supplier = $supplier;
        $this->customer = $customer;
        $this->accountHead = $accountHead;
        $this->transaction = $transaction;
        $this->accountsModel = $accounts;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }
    public function charts()
    {
        $this->authorize('coa', $this->accountsModel);

        $userList = $this->accountHead->where('IsActive',1)
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->orderBy('HeadName')->get();

//        $data = \QueryHelper::non_current_ass_opening();
//        print_r($data);
//        return ;
//            $visit=array();
//        for ($i = 0; $i < count($userList); $i++)
//        {
//            $visit[$i] = false;
//        }
//        $results = \QueryHelper::expense_opening();
////
//        echo "<pre>";
//        print_r($results);
//        return;


        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Chart of Accounts' => ''
        ]);

        $page_title = "Chart of Accounts";
        return view('dashboard.accounts.account.charts_account',compact('page_title', 'breadcrumbs','userList'));
    }
    public function opening() {
        $this->authorize('openingBalanceVoucher', $this->accountsModel);

        $page_title = __('accounts.vouchers.opening_balance_voucher');
        $breadcrumbs = collect([
            __('accounts.general.dashboard') => route('dashboard'),
            __('accounts.vouchers.opening_balance_voucher') => '',
        ]);

        $heads = $this->accountHead->where('IsActive',1)
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->orderByRaw('PHeadName ASC, HeadName ASC')->get();
        $accountHeads = \AccountHelper::generalHeadsDropDown($heads);

        $vocherNo = Prefixes::generateNumber('Opening');
        return view('dashboard.accounts.account.opening_balance',compact('page_title','breadcrumbs','vocherNo','accountHeads'));
    }
    public function addOpeningBalance(Request $request){
        $this->authorize('openingBalanceVoucher', $this->accountsModel);

        $transaction = $this->transaction->create([
            'VNo'            => $request->voucher_no,
            'Vtype'          => 'Opening',
            'VDate'          => $request->date,
            'COAID'          => $request->account_head,
            'Narration'      => $request->remarks,
            'Debit'          => $request->amount,
            'Credit'         => 0,
            'IsPosted'       => 1,
            'is_opening'     => 1,
            'created_by'     => auth()->user()->id,
            'created_at'     => $request->date,
            'IsAppove'       => 1,
            'location_id'    => $this->location,
        ]);
        Prefixes::updateNumber('Opening');

        if ($request->doPrint == 1) {
            return redirect()->route('common.payment.receipt', ['VNo' => $transaction->VNo, 'type' => 'Opening']);
        } else {
            return redirect()->route('opening.balance')->with('success', 'Opening balance record saved successfully!');
        }
    }

    public function supplierPayment() {
        $this->authorize('supplierPaymentVoucher', $this->accountsModel);

        $page_title = __('accounts.supplier.voucher_title');
        $breadcrumbs = collect([
            __('accounts.general.dashboard') => route('dashboard'),
            __('accounts.supplier.voucher_title') => '',
        ]);

        $supplier = $this->supplier->where('location_id', $this->location)
            ->orderBy('supplier_name', 'ASC')->pluck('supplier_name','id');

        $vocherNo = Prefixes::generateNumber('PM');

        $paymentTypes = [1 => 'Cash Payment'];
        $paymentAccounts = AccountHead::whereHas('pettycash', function($query) {
            if (auth()->user()->id > 1) {
                $query->where('id', auth()->user()->id);
            }
        })->orWhere('HeadCode', 'like', 102010 . '%')
            ->where('HeadCode', '!=', 1020102)
            ->pluck('HeadName','HeadCode');

        return view('dashboard.accounts.account.supplier_payment',compact('page_title','breadcrumbs','vocherNo','supplier', 'paymentTypes', 'paymentAccounts'));
    }
    public function addSupplierPayment(Request $request){
        $this->authorize('supplierPaymentVoucher', $this->accountsModel);

        $headcode   = $this->accountHead->where('supplier_id',$request->supplier_id)->value('HeadCode');
        $supplierName = $this->supplier->getSupplierName($request->supplier_id);

        $paymentAccountHeadCode = $request->payment_account;
        $paymentAccountHeadName = AccountHead::where('HeadCode', $paymentAccountHeadCode)->value('HeadName');

        //supplier debit
        $transaction = $this->transaction->create([
            'VNo'            => $request->voucher_no,
            'Vtype'          => 'PM',
            'VDate'          => $request->date,
            'COAID'          => $headcode,
            'Narration'      => $request->remarks,
            'Debit'          => $request->amount,
            'Credit'         => 0,
            'IsPosted'       => 1,
            'is_opening'     => 1,
            'created_by'     => auth()->user()->id,
            'created_at'     => $request->date,
            'IsAppove'       => 1,
            'location_id'    => $this->location,
        ]);
        //cash in hand account
         $this->transaction->create([
            'VNo'            => $request->voucher_no,
            'Vtype'          => 'PM',
            'VDate'          => $request->date,
            'COAID'          => $paymentAccountHeadCode,
            'Narration'      => $paymentAccountHeadName . ' Credit for Supplier Payment to '.$supplierName,
            'Debit'          => 0,
            'Credit'         => $request->amount,
            'IsPosted'       => 1,
            'is_opening'     => 1,
            'created_by'     => auth()->user()->id,
             'created_at'     => $request->date,
            'IsAppove'       => 1,
             'location_id'    => $this->location,
        ]);

        Prefixes::updateNumber('PM');

        if ($request->doPrint == 1) {
            return redirect()->route('common.payment.receipt', ['VNo' => $transaction->VNo, 'type' => 'PM']);
        } else {
            return redirect()->route('supplier.payment')->with('success', "Supplier payment record saved successfully!");
        }
    }
    public function supplierPaymentReceipt($transactionId){
        abort(404);
        $page_title = __('accounts.supplier.voucher_receipt_title');
        $breadcrumbs = collect([
            __('accounts.general.dashboard') => route('dashboard'),
            __('accounts.supplier.voucher_receipt_title') => '',
        ]);

        $transactions = $this->transaction->where('id', $transactionId )->get();

        return view('dashboard.accounts.account.supplier_payment_receipt',compact('page_title','breadcrumbs','transactions'));
    }

    public function customerReceive() {
        abort(404);
        $this->authorize('customerReceiveVoucher', $this->accountsModel);

        $page_title = __('accounts.customers.voucher_title');
        $breadcrumbs = collect([
            __('accounts.general.dashboard') => route('dashboard'),
            'Manage Customers' => route('dashboard.accounts.customer.index'),
            __('accounts.customers.voucher_title') => '',
        ]);

        $customer = $this->customer->where('location_id', $this->location)
            ->orderBy('customer_name', 'ASC')->pluck('customer_name','id');

        $vocherNo = Prefixes::generateNumber('CR');

        $paymentTypes = [1 => 'Cash Payment'];
        $paymentAccounts = AccountHead::whereHas('pettycash', function($query) {
            if (auth()->user()->id > 1) {
                $query->where('id', auth()->user()->id);
            }
        })->orWhere('HeadCode', 'like', 102010 . '%')
            ->where('HeadCode', '!=', 1020102)
            ->pluck('HeadName','HeadCode');
        return view('dashboard.accounts.account.customer_receive',compact('page_title','breadcrumbs','vocherNo','customer', 'paymentTypes', 'paymentAccounts'));
    }
    public function addCustomerReceive(Request $request) {
        $this->authorize('customerReceiveVoucher', $this->accountsModel);

        $headcode   = $this->accountHead->where('customer_id',$request->customer_id)->value('HeadCode');
        $customerName = $this->customer->getCustomerName($request->customer_id);

        $paymentAccountHeadCode = $request->payment_account;
        $paymentAccountHeadName = AccountHead::where('HeadCode', $paymentAccountHeadCode)->value('HeadName');

        //Customer Credit
        $transaction = $this->transaction->create([
            'VNo'            => $request->voucher_no,
            'Vtype'          => 'CR',
            'VDate'          => $request->date,
            'COAID'          => $headcode,
            'Narration'      => $request->remarks,
            'Debit'          => 0,
            'Credit'         => $request->amount,
            'IsPosted'       => 1,
            'is_opening'     => 1,
            'created_by'     => auth()->user()->id,
            'created_at'     => $request->date,
            'IsAppove'       => 1,
            'location_id'    => $this->location,
        ]);
        //cash in hand account
        $this->transaction->create([
            'VNo'            => $request->voucher_no,
            'Vtype'          => 'CR',
            'VDate'          => $request->date,
            'COAID'          => $paymentAccountHeadCode,
            'Narration'      => $paymentAccountHeadName . ' Debit for Customer Receiving from '.$customerName,
            'Debit'          => $request->amount,
            'Credit'         => 0,
            'IsPosted'       => 1,
            'is_opening'     => 1,
            'created_by'     => auth()->user()->id,
            'created_at'     => $request->date,
            'IsAppove'       => 1,
            'location_id'    => $this->location,
        ]);
        Prefixes::updateNumber('CR');
        if ($request->doPrint == 1) {
            return redirect()->route('common.payment.receipt', ['VNo' => $transaction->VNo, 'type' => 'CR']);
        } else {
            return redirect()->route('customer.receive')->with('success', "Customer payment record saved successfully!");
        }
    }
    public function customerPaymentReceipt($transactionId) {
        abort(404);
        $page_title = __('accounts.customers.voucher_receipt_title');
        $breadcrumbs = collect([
            __('accounts.general.dashboard') => route('dashboard'),
            __('accounts.customers.voucher_receipt_title') => '',
        ]);
        $transactions = $this->transaction->where('id', $transactionId )->get();

        return view('dashboard.accounts.account.customer_payment_receipt',compact('page_title','breadcrumbs','transactions'));
    }

    public function cashAdjustment()
    {
        $this->authorize('cashAdjustmentVoucher', $this->accountsModel);

        $vocherNo = Prefixes::generateNumber('AD');

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Cash Adjustment Voucher' => ''
        ]);

        $page_title = "Cash Adjustment Voucher";

        $cashAccounts = AccountHead::whereHas('pettycash', function($query) {
            if (auth()->user()->id > 1) {
                $query->where('id', auth()->user()->id);
            }
        })->orWhere('HeadCode', 'like', 102010 . '%')
            ->where('HeadCode', '!=', 1020102)
            ->pluck('HeadName','HeadCode');

        return view('dashboard.accounts.account.cash_adjustment',compact('page_title', 'breadcrumbs','vocherNo','cashAccounts'));
    }
    public function addCashAdjustment(Request $request){
        $this->authorize('cashAdjustmentVoucher', $this->accountsModel);

        $cashAccountHeadCode = $request->cash_account;

        if($request->payment_type == 1){
            $debit  = $request->amount;
            $credit = 0;
        }
        if($request->payment_type == 2){
            $debit  = 0;
            $credit = $request->amount;
        }
        //cash in hand account
        $transaction = $this->transaction->create([
            'VNo'            => $request->voucher_no,
            'Vtype'          => 'AD',
            'VDate'          => $request->date,
            'COAID'          => $cashAccountHeadCode,
            'Narration'      => $request->remarks,
            'Debit'          => $debit,
            'Credit'         => $credit,
            'IsPosted'       => 1,
            'is_opening'     => 1,
            'created_by'     => auth()->user()->id,
            'created_at'     => $request->date,
            'IsAppove'       => 1,
            'location_id'    => $this->location,
        ]);
        Prefixes::updateNumber('AD');

        if ($request->doPrint == 1) {
            return redirect()->route('common.payment.receipt', ['VNo' => $transaction->VNo, 'type' => 'AD']);
        } else {
            return redirect()->route('cash.adjustment')->with('success', __('accounts.vouchers.add'));
        }
    }

    public function CommonPaymentReceipt(Request $request){

        $data = [];
        $title = '';
        $page_title = '';
        $breadcrumbs = '';

        $voucher_no = $request->VNo;

        if ($request->has('type')) {
            switch (strtoupper($request->type)) {
                case 'CR':
                    $page_title = __('accounts.customers.voucher_receipt_title');
                    $title = __('accounts.customers.voucher_receipt_title');
                    $breadcrumbs = collect([
                        __('accounts.general.dashboard') => route('dashboard'),
                        'Manage Customers' => route('dashboard.accounts.customer.index'),
                        __('accounts.customers.voucher_receipt_title') => '',
                    ]);
                    $transactions = $this->transaction->where('VNo', $voucher_no)->first();
                    $data = collect(['CR' => true, 'transactions' => $transactions,
                        'partyName'=>$transactions->accountHead->customer->customer_name, 'VNo'=>$transactions->VNo,
                        'VDate'=>\AccountHelper::date_format($transactions->VDate),
                        'cancelRoute'=>'dashboard.accounts.customer.index']);
                    break;

                case 'PM':
                    $page_title = __('accounts.supplier.voucher_receipt_title');
                    $title = __('accounts.supplier.voucher_receipt_title');
                    $breadcrumbs = collect([
                        __('accounts.general.dashboard') => route('dashboard'),
                        'Suppliers' => route('dashboard.accounts.supplier.index'),
                        __('accounts.supplier.voucher_receipt_title') => ''
                    ]);
                    $transactions = $this->transaction->where('VNo', $voucher_no)->first();
                    $data = collect(['PM' => true, 'transactions' => $transactions,
                        'partyName'=>$transactions->accountHead->supplier->supplier_name, 'VNo'=>$transactions->VNo,
                        'VDate'=>\AccountHelper::date_format($transactions->VDate),
                        'cancelRoute'=>'dashboard.accounts.supplier.index']);
                    break;

                case 'JV':
                $page_title = 'Journal Voucher Receipt';
                $title = 'Journal Voucher Receipt';
                $breadcrumbs = collect([
                    __('accounts.general.dashboard') => route('dashboard'),
                    'Journal Voucher Receipt' => ''
                ]);
                $transactions = $this->transaction->where('VNo', $voucher_no)->get();
                $data = collect(['JV' => true, 'transactions' => $transactions,
                    'partyName'=>'', 'VNo'=>$transactions[0]->VNo,
                    'VDate'=>\AccountHelper::date_format($transactions[0]->VDate),
                    'cancelRoute'=>'dashboard.accounts.journal.voucher.create']);
                break;

                case 'OPENING':
                    $page_title = 'Opening Balance Voucher Receipt';
                    $title = 'Opening Balance Voucher Receipt';
                    $breadcrumbs = collect([
                        __('accounts.general.dashboard') => route('dashboard'),
                        'Opening Balance Voucher Receipt' => '',
                    ]);
                    $transactions = $this->transaction->where('VNo', $voucher_no)->first();
                    $data = collect(['Opening' => true, 'transactions' => $transactions,
                        'partyName'=>'', 'VNo'=>$transactions->VNo,
                        'VDate'=>\AccountHelper::date_format($transactions->VDate),
                        'cancelRoute'=>'opening.balance']);
                    break;

                case 'AD':
                    $page_title = 'Cash Adjustment Voucher Receipt';
                    $title = 'Cash Adjustment Voucher Receipt';
                    $breadcrumbs = collect([
                        __('accounts.general.dashboard') => route('dashboard'),
                        'Cash Adjustment Voucher Receipt' => '',
                    ]);
                    $transactions = $this->transaction->where('VNo', $voucher_no)->first();
                    $data = collect(['AD' => true, 'transactions' => $transactions,
                        'partyName'=>'', 'VNo'=>$transactions->VNo,
                        'VDate'=>\AccountHelper::date_format($transactions->VDate),
                        'cancelRoute'=>'cash.adjustment']);
                    break;

                case 'DV':
                    $page_title = 'Debit Voucher Receipt';
                    $title = 'Debit Voucher Receipt';
                    $breadcrumbs = collect([
                        __('accounts.general.dashboard') => route('dashboard'),
                        'Debit Voucher Receipt' => '',
                    ]);
                    $transactions = $this->transaction->where('VNo', $voucher_no)->get();
                    $data = collect(['DV' => true, 'transactions' => $transactions,
                        'partyName'=>'', 'VNo'=>$transactions[0]->VNo,
                        'VDate'=>\AccountHelper::date_format($transactions[0]->VDate),
                        'cancelRoute'=>'dashboard.accounts.debit.voucher.create']);
                    break;

                case 'CV':
                    $page_title = 'Credit Voucher Receipt';
                    $title = 'Credit Voucher Receipt';
                    $breadcrumbs = collect([
                        __('accounts.general.dashboard') => route('dashboard'),
                        'Credit Voucher Receipt' => '',
                    ]);
                    $transactions = $this->transaction->where('VNo', $voucher_no)->get();
                    $data = collect(['CV' => true, 'transactions' => $transactions,
                        'partyName'=>'', 'VNo'=>$transactions[0]->VNo,
                        'VDate'=>\AccountHelper::date_format($transactions[0]->VDate),
                        'cancelRoute'=>'dashboard.accounts.credit.voucher.create']);
                    break;

                case 'CONTRA':
                    $page_title = 'Contra Voucher Receipt';
                    $title = 'Contra Voucher Receipt';
                    $breadcrumbs = collect([
                        __('accounts.general.dashboard') => route('dashboard'),
                        'Contra Voucher Receipt' => ''
                    ]);
                    $transactions = $this->transaction->where('VNo', $voucher_no)->get();
                    $data = collect(['Contra' => true, 'transactions' => $transactions,
                        'partyName'=>'', 'VNo'=>$transactions[0]->VNo,
                        'VDate'=>\AccountHelper::date_format($transactions[0]->VDate),
                        'cancelRoute'=>'dashboard.accounts.contra.voucher.create']);
                    break;

                case 'EXPENSE':
                    $page_title = __('accounts.expense.voucher_receipt_title');
                    $title = __('accounts.expense.voucher_receipt_title');
                    $breadcrumbs = collect([
                        __('accounts.general.dashboard') => route('dashboard'),
                        'Manage Expense' => route('dashboard.accounts.expense.index'),
                        __('accounts.expense.voucher_receipt_title') => '',
                    ]);
                    $transactions = $this->transaction->where('VNo', $voucher_no)->first();
                    $data = collect(['Expense' => true, 'transactions' => $transactions,
                        'partyName'=>$transactions->accountHead->HeadName, 'VNo'=>$transactions->VNo,
                        'VDate'=>\AccountHelper::date_format($transactions->VDate),
                        'cancelRoute'=>'dashboard.accounts.expense.index']);
                    break;

                case 'BOOKING':
                    $page_title = 'Event Booking Payment Receipt';
                    $title = 'Event Booking Payment Receipt';
                    $breadcrumbs = collect([
                        'Dashboard' => route('dashboard'),
                        'Event Bookings' => route('dashboard.marquee.booking.index'),
                        'Booking Payment Receipt' => ''
                    ]);
                    $transactions = $this->transaction->where('VNo', $voucher_no)->first();
                    $data = collect(['Booking' => true, 'transactions' => $transactions,
                        'partyName'=>$transactions->accountHead->customer->customer_name, 'VNo'=>$transactions->VNo,
                        'VDate'=>\AccountHelper::date_format($transactions->VDate),
                        'cancelRoute'=>'dashboard.marquee.booking.index']);
                    break;

                case 'STAGE':
                    $page_title = 'Stage Booking Payment Receipt';
                    $title = 'Stage Booking Payment Receipt';
                    $breadcrumbs = collect([
                        'Dashboard' => route('dashboard'),
                        'Stage & Decor Bookings' => route('dashboard.marquee.stage.booking.index'),
                        'Stage Booking Payment Receipt' => ''
                    ]);
                    $transactions = $this->transaction->where('VNo', $voucher_no)->first();
                    $data = collect(['Stage' => true, 'transactions' => $transactions,
                        'partyName'=>$transactions->accountHead->customer->customer_name, 'VNo'=>$transactions->VNo,
                        'VDate'=>\AccountHelper::date_format($transactions->VDate),
                        'cancelRoute'=>'dashboard.marquee.stage.booking.index']);
                        break;
                case 'LOAN':
                    $page_title = __('accounts.employee_loan.voucher_receipt_title');
                    $title = __('accounts.employee_loan.voucher_receipt_title');
                    $breadcrumbs = collect([
                        __('accounts.general.dashboard') => route('dashboard'),
                        __('accounts.employee_loan.manage_loan') => route('dashboard.accounts.employee_loan.index'),
                        __('accounts.employee_loan.voucher_receipt_title') => '',
                    ]);
                    $transactions = $this->transaction->where('VNo', $voucher_no)->orderBy('id', 'DESC')->first();
                    $data = collect(['Loan' => true, 'transactions' => $transactions,
                        'partyName'=>$transactions->accountHead->HeadName, 'VNo'=>$transactions->VNo,
                        'VDate'=>\AccountHelper::date_format($transactions->VDate),
                        'cancelRoute'=>'dashboard.accounts.employee_loan.index']);
                    break;

                case 'LOANPAY':
                    $page_title = __('accounts.employee_loan.voucher_payment_title');
                    $title = __('accounts.employee_loan.voucher_payment_title');
                    $breadcrumbs = collect([
                        __('accounts.general.dashboard') => route('dashboard'),
                        __('accounts.employee_loan.manage_loan') => route('dashboard.accounts.employee_loan.index'),
                        __('accounts.employee_loan.voucher_payment_title') => '',
                    ]);
                    $transactions = $this->transaction->where('VNo', $voucher_no)->orderBy('id', 'ASC')->first();
                    $data = collect(['LoanPay' => true, 'transactions' => $transactions,
                        'partyName'=>$transactions->accountHead->HeadName, 'VNo'=>$transactions->VNo,
                        'VDate'=>\AccountHelper::date_format($transactions->VDate),
                        'cancelRoute'=>'dashboard.accounts.employee_loan.index']);
                    break;
            }
        } else {
            $page_title = 'Voucher Receipt';
            $title = 'Voucher Receipt';
            $breadcrumbs = collect([
                __('accounts.general.dashboard') => route('dashboard'),
                'Voucher Receipt' => ''
            ]);
            $transactions = $this->transaction->where('VNo', $voucher_no)->get();
            $data = collect(['Other' => true, 'transactions' => $transactions,
                'partyName'=>$transactions[0]->accountHead->HeadName, 'VNo'=>$transactions[0]->VNo,
                'VDate'=>\AccountHelper::date_format($transactions[0]->VDate)]);
        }

        return view('dashboard.accounts.common.common-receipt',compact('page_title','breadcrumbs', 'title', 'data'));
    }

    public function approvalVoucher()
    {
        abort(404);
        $values = array("DV", "CV", "JV","Contra");
        $approvalInfo = $this->transaction->whereIn('Vtype',$values)->where('IsAppove',0)->get();
        return view('dashboard.accounts.account.voucher_approval',compact('approvalInfo'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getHeadCode($id){

        $accountHead = $this->accountHead->where('HeadCode',$id)->first();
        return $accountHead->HeadCode;

    }

    public function getHeadName($id){

        $accountHead = $this->accountHead->where('HeadCode',$id)->first();
        return $accountHead->HeadName;

    }

    public function ApiAccountHeadBalance(Request $request) {
        $account_balance = 0;
        if ($request->ajax()) {
            $account = $this->accountHead
                ->where(function ($query) {
                    $query->whereNull('location_id')->orWhere('location_id', $this->location);
                })
                ->findorFail($request->accountID);
            if ($account) {
                $headCode = $account->HeadCode;
                $headName = $account->HeadName;

                $query  = $this->transaction
                    ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                    ->where('transactions.IsAppove',1)
                    ->where('transactions.COAID',$headCode)
                    ->where('location_id', $this->location)
                    ->first();

                $temp_bal = $query->predebit - $query->precredit;
                $account_balance += (!empty($temp_bal)?$temp_bal:0);

                $balance = \AccountHelper::number_format($account_balance);
//                $balance = $account_balance > 0 ? (\AccountHelper::number_format($account_balance) . "<small> DR</small>") : (\AccountHelper::number_format($account_balance * -1) . "<small> CR</small>");

                $output = ['success' => true,
                    'msg' => '', 'balance' => $balance
                ];
            } else {
                $output = ['success' => false,
                    'msg' => __("accounts.messages.something_went_wrong")
                ];
            }

        } else {
            $output = ['success' => false,
                'msg' => __("accounts.messages.invalid_request")
            ];
        }

        return $output;
    }

    public function createAccountHead(){
        $this->authorize('createAccountHead', $this->accountsModel);

        $page_title = "Create New Account Head";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Create New Account Head' => ''
        ]);

        $heads = $this->accountHead
            ->where('IsGL',1)
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->orderByRaw('PHeadName ASC, HeadName ASC')->get();

        $parentHead = \AccountHelper::generalHeadsDropDown($heads);

        return view('dashboard.accounts.account.create_account_head',compact('page_title','parentHead'));
    }

    public function AddAccountHead(Request $request){

        $this->authorize('createAccountHead', $this->accountsModel);

        $pHeadCode = $request->parent_head;
        $child_account = $request->child_account;
        $parentAccount = $this->accountHead->where('HeadCode',$pHeadCode)->first();
        $headCode = $this->accountHead->headCode($pHeadCode);



      $data =  $this->accountHead::create(
           [
                'HeadCode'         => $headCode,
                'HeadName'         => $child_account,
                'PHeadName'        => $parentAccount->HeadName,
                'HeadLevel'        => $parentAccount->HeadLevel+1,
                'IsActive'         => '1',
                'IsTransaction'    => '1',
                'IsGL'             => '0',
                'HeadType'         => $parentAccount->HeadType,
                'IsBudget'         => '0',
                'IsDepreciation'   => '0',
                'DepreciationRate' => '0',
               'location_id'       => $this->location,
            ]
        );
        $data->HeadName = $data->id."-".$child_account;
        $data->save();

        return redirect()->route('create.account')->with('success', trans('accounts.messages.account_created_msg'));
    }

    public function getPaymentAccountsByType(Request $request) {
        $output = ['success' => false,  'msg' => __("accounts.messages.something_went_wrong") ];
        if ($request->ajax() && $request->isMethod('POST')) {
            if ($request->has('paymentType')) {
                $paymentType = $request->paymentType;
                if ($paymentType == 1) { //Cash Accounts
                    $accounts = $this->accountHead->whereHas('pettycash', function($query) {
                        if (!auth()->user()->hasRole('admin') || !auth()->user()->hasRole('super-admin')) {
                            $query->where('id', auth()->user()->id);
                        }
                    })->orWhere('HeadCode',1020101)->pluck('HeadName','HeadCode');

                } else {

                }
                $output = ['success' => true,  'msg' => '', 'records' => $accounts];
            } else {
                $output = ['success' => false,
                    'msg' => __("accounts.messages.invalid_request")
                ];
            }
        } else {
            $output = ['success' => false,
                'msg' => __("accounts.messages.invalid_request")
            ];
        }

        return $output;
    }
}
