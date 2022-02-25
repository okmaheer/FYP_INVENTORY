<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\Accounts;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Prefixes;

class JournalVoucherController extends Controller
{
    public $accountHead;
    public $transaction;
    protected $accountsModel;
    private $location;

    public function __construct(Accounts $accounts, AccountHead $accountHead,Transaction $transaction){
        $this->middleware('auth');
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
        //
    }

    public function create()
    {
        $this->authorize('journalVoucher', $this->accountsModel);

        $heads = $this->accountHead->where('IsActive',1)->where('IsTransaction',1)
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->orderByRaw('PHeadName ASC, HeadName ASC')->get();

        $accountHeads = \AccountHelper::generalHeadsDropDown($heads);

        $vocherNo = Prefixes::generateNumber('JV');

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
             'Journal Voucher' => ''
        ]);

        $page_title = "Journal Voucher";

        return view('dashboard.accounts.account.vouchers.journal.create',compact('page_title', 'breadcrumbs','vocherNo','accountHeads'));
    }

    public function store(Request $request)
    {
        $this->authorize('journalVoucher', $this->accountsModel);

        $cAID      = $request->txtCode;
        $dAID      = $request->cmbDebit;
        $debit     = $request->txtAmount;
        $credit    = $request->txtAmountcr;

        for ($i=0; $i < count($cAID); $i++) {

            $crtid = $cAID[$i];
            $Cramnt= $credit[$i];
            $debits= $debit[$i];

            //Contra Insert
            $transaction = $this->transaction->create([
                'VNo' => $request->voucher_no,
                'Vtype' => 'JV',
                'VDate' => $request->date,
                'COAID'  =>  $crtid,
                'Narration' => $request->remarks,
                'Debit' => $debits,
                'Credit' => $Cramnt,
                'IsPosted' => 1,
                'is_opening' => 1,
                'created_by' => auth()->user()->id,
                'IsAppove' => 0,
                'location_id' => $this->location,
            ]);

            Prefixes::updateNumber('JV');
        }

        if ($request->doPrint == 1) {
            return redirect()->route('common.payment.receipt', ['VNo' => $transaction->VNo, 'type' => 'JV']);
        } else {
            return redirect()->route('dashboard.accounts.journal.voucher.create')->with('success', __('accounts.vouchers.add'));
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->authorize('journalVoucher', $this->accountsModel);

        $voucherInfo = $this->transaction
            ->where('VNo',$id)
            ->where('location_id', $this->location)
            ->get();

        return view('dashboard.accounts.account.vouchers.journal.edit',compact('voucherInfo'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('journalVoucher', $this->accountsModel);

        $this->transaction->where('VNo',$id)->where('location_id', $this->location)->delete();
        $cAID      = $request->txtCode;
        $dAID      = $request->cmbDebit;
        $debit     = $request->txtAmount;
        $credit    = $request->txtAmountcr;

        for ($i=0; $i < count($cAID); $i++) {

            $crtid = $cAID[$i];
            $Cramnt= $credit[$i];
            $debits= $debit[$i];

            //Contra Insert
            $this->transaction->create([
                'VNo' => $request->voucher_no,
                'Vtype' => 'JV',
                'VDate' => $request->date,
                'COAID'  =>  $crtid,
                'Narration' => $request->remarks,
                'Debit' => $debits,
                'Credit' => $Cramnt,
                'IsPosted' => 1,
                'is_opening' => 1,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
                'created_at' => $request->date,
                'updated_at' => $request->date,
                'IsAppove' => 0,
                'location_id' => $this->location,
            ]);


        }

        return redirect()->route('dashboard.accounts.journal.voucher.create')->with('success',__('accounts.vouchers.add'));
    }

    public function destroy($id)
    {
        //
    }
}
