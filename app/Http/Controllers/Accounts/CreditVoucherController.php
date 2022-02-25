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

class CreditVoucherController extends Controller
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
        $this->authorize('creditVoucher', $this->accountsModel);

        $heads = $this->accountHead->where('IsActive',1)->where('IsTransaction',1)
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->orderByRaw('PHeadName ASC, HeadName ASC')->get();
        $accountHeads = \AccountHelper::generalHeadsDropDown($heads);

        $cih = $this->accountHead->whereHas('pettycash', function($query) {
            if (auth()->user()->id > 1) {
                $query->where('id', auth()->user()->id);
            }
        })->orWhere('HeadCode', 'like', 102010 . '%')
            ->where('HeadCode', '!=', 1020102)
            ->pluck('HeadName','HeadCode');

        $vocherNo = Prefixes::generateNumber('CV');

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Credit Voucher' => ''
        ]);

        $page_title = "Credit Voucher";

        return view('dashboard.accounts.account.vouchers.credit.create',compact('page_title', 'breadcrumbs','vocherNo','cih','accountHeads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('creditVoucher', $this->accountsModel);

        $cAID      = $request->txtCode;
        $dAID      = $request->cmbDebit;
        $Credit     = $request->txtAmount;

        for ($i=0; $i < count($cAID); $i++) {

            $crtid = $cAID[$i];
            $Cramnt= $Credit[$i];

            //Debit Insert
            $this->transaction->create([
                'VNo' => $request->voucher_no,
                'Vtype' => 'CV',
                'VDate' => $request->date,
                'COAID' => $crtid,
                'Narration' => $request->remarks,
                'Debit' => 0,
                'Credit' => $Cramnt,
                'IsPosted' => 1,
                'is_opening' => 1,
                'created_by' => auth()->user()->id,
                'created_at' => $request->date,
                'IsAppove' => 0,
                'location_id' => $this->location,
            ]);


            $headName = \AccountHelper::getHeadName($crtid);

            //cash in hand account Credit
            $transaction = $this->transaction->create([
                'VNo' => $request->voucher_no,
                'Vtype' => 'CV',
                'VDate' => $request->date,
                'COAID' => $dAID,
                'Narration' => 'Credit voucher from ' . $headName,
                'Debit' => $Cramnt,
                'Credit' => 0,
                'IsPosted' => 1,
                'is_opening' => 1,
                'created_by' => auth()->user()->id,
                'created_at' => $request->date,
                'IsAppove' => 0,
                'location_id' => $this->location,
            ]);
            Prefixes::updateNumber('CV');
        }

        if ($request->doPrint == 1) {
            return redirect()->route('common.payment.receipt', ['VNo' => $transaction->VNo, 'type' => 'CV']);
        } else {
            return redirect()->route('dashboard.accounts.credit.voucher.create')->with('success', __('accounts.vouchers.add'));
        }
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
        $this->authorize('creditVoucher', $this->accountsModel);

        $crVoucherInfo = $this->transaction
            ->where('VNo',$id)
            ->where('Debit','<',1)
            ->where('location_id', $this->location)
            ->get();
        $debitInfo = $this->transaction
            ->where('VNo',$id)
            ->where('Credit','<',1)
            ->where('location_id', $this->location)
            ->get();

        return view('dashboard.accounts.account.vouchers.credit.edit',compact('crVoucherInfo','debitInfo'));
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
        $this->authorize('creditVoucher', $this->accountsModel);

        $this->transaction->where('VNo',$id)->where('location_id', $this->location)->delete();
        $cAID      = $request->txtCode;
        $dAID      = $request->cmbDebit;
        $Credit     = $request->txtAmount;

        for ($i=0; $i < count($cAID); $i++) {

            $crtid = $cAID[$i];
            $Cramnt= $Credit[$i];

            //Debit Insert
            $this->transaction->create([
                'VNo' => $request->voucher_no,
                'Vtype' => 'CV',
                'VDate' => $request->date,
                'COAID' => $crtid,
                'Narration' => $request->remarks,
                'Debit' => 0,
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


            $headName = \AccountHelper::getHeadName($crtid);

            //cash in hand account Credit
            $this->transaction->create([
                'VNo' => $request->voucher_no,
                'Vtype' => 'CV',
                'VDate' => $request->date,
                'COAID' => $dAID,
                'Narration' => 'Credit voucher from ' . $headName,
                'Debit' => $Cramnt,
                'Credit' => 0,
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

        return redirect()->route('dashboard.accounts.credit.voucher.create')->with('success',__('accounts.vouchers.add'));
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
}
