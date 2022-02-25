<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\Accounts;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class AccountVoucherController extends Controller
{
    public $supplier;
    public $customer;
    public $accountHead;
    public $transaction;
    protected $accountsModel;
    private $location;

    public function __construct(Accounts $accounts, Supplier $supplier, Customer $customer, AccountHead $accountHead, Transaction $transaction)
    {
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
    public function index()
    {
        $this->authorize('voucherApproval', $this->accountsModel);

        $values = ["DV", "CV", "JV","Contra"];

        $approvalInfo = $this->transaction
            ->selectRaw('VNo,VDate,VType,sum(Credit) as Credit,sum(Debit) as Debit')
            ->whereIn('Vtype',$values)
            ->where('IsPosted',1)
            ->where('IsAppove',0)
            ->where('location_id', $this->location)
            ->groupBy('VNo','VDate','VType')
            ->get();

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
             'Voucher Approval' => ''
        ]);

        $page_title = "Voucher Approval";


        return view('dashboard.accounts.account.voucher_approval',compact(
            'page_title', 'breadcrumbs','approvalInfo'));
    }
    public function create()
    {

    }
    public function show()
    {

    }
    public function store()
    {

    }
    public function edit($id)
    {
        abort(404);
        $this->authorize('voucherApproval', $this->accountsModel);

        $accountHeads = $this->accountHead->where('IsActive',1)->where('IsTransaction',1)->pluck('HeadName','HeadCode');
        $voucher = $this->transaction->where('location_id', $this->location)->findorFail($id);
//        echo "<pre>";
//        print_r($voucher[0]->id);
//        return;
        return view('dashboard.accounts.account.edit_voucher',compact('voucher','accountHeads'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('voucherApproval', $this->accountsModel);

        $this->transaction = $this->transaction->where('VNo',$id)
            ->where('location_id', $this->location)
            ->update(['IsAppove'=>1]);


        return redirect()->route('dashboard.accounts.voucher.approval.index')->with('success',__('accounts.vouchers.approve'));
    }
    public function destroy($id)
    {
        $this->authorize('voucherApproval', $this->accountsModel);

        $transaction = $this->transaction->where('VNo',$id)->where('location_id', $this->location);
        $transaction->delete();
        return redirect()->route('dashboard.accounts.voucher.approval.index');
    }
}
