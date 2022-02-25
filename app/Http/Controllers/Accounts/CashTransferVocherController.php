<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\Accounts;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Prefixes;

class CashTransferVocherController extends Controller
{
    public $accountHead;
    public $transaction;
    protected $accountsModel;

    public function __construct(Accounts $accounts, AccountHead $accountHead,Transaction $transaction){
        $this->middleware('auth');
        $this->accountHead = $accountHead;
        $this->transaction = $transaction;
        $this->accountsModel = $accounts;
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
        abort(404);
        $this->authorize('cashTransferVoucher', $this->accountsModel);

        $accountHeads = $this->accountHead->where('IsActive',1)->where('IsTransaction',1)
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->pluck('HeadName','HeadCode');

        $cih = $this->accountHead->where('HeadCode', 'LIKE',  '102010' . '%')->where(['IsTransaction' => 1,'HeadLevel' => 3])
            ->where(function ($query) {
                $query->whereNull('location_id')->orWhere('location_id', $this->location);
            })
            ->pluck('HeadName','HeadCode');

        $vocherNo = Prefixes::generateNumber('CV');

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Cash Transfer Voucher' => ''
        ]);

        $page_title = "Credit Voucher";

        return view('dashboard.accounts.account.vouchers.cashtransfer.create',compact('page_title', 'breadcrumbs','vocherNo','cih','accountHeads'));
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
        $this->authorize('cashTransferVoucher', $this->accountsModel);
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
        $this->authorize('cashTransferVoucher', $this->accountsModel);
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
        $this->authorize('cashTransferVoucher', $this->accountsModel);
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
}
