<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\Transaction;
use App\Traits\General;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Bank;
use Intervention\Image\Facades\Image;

class BankController extends Controller
{
    use General;

    public $model;
    public $accountHead;
    public $transaction;
    private $location;

    function __construct(Bank $bank, AccountHead $accountHead,Transaction $transaction)
    {
        $this->middleware('auth');
        $this->model = $bank;
        $this->accountHead = $accountHead;
        $this->transaction = $transaction;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function transaction()
    {
        $this->authorize('transactions', $this->model);

        $banks = $this->model->pluck('name','id');
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Bank' => route('dashboard.accounts.bank.index'),
            'Bank Transaction' => ''
        ]);

        $page_title = "Bank Transaction";
        return view('dashboard.accounts.Bank.bank_transaction',compact('page_title', 'breadcrumbs','banks'));
    }
    public function addTransaction(Request $request)
    {
        $this->authorize('transactions', $this->model);

        if ($request->bank_transaction_type == 1) {
            $dr = $request->amount;
        } else {
            $cr = $request->amount;
        }
        //get headcode from table
        $bank = $this->model->where('id',$request->bank_name)->first();
        $bankAccountHead = $bank->account_name." - ".$bank->name;
        $bankAccountHead = $this->accountHead->where('HeadName',$bankAccountHead)->first();

        //Account Head Bank transaction
        $this->transaction->create([
            'VNo' => $request->withdraw_deposit_id,
            'Vtype' => 'Bank Transaction',
            'VDate' => $request->date,
            'COAID'  =>  $bankAccountHead->HeadCode,
            'Narration' => $request->remarks,
            'Debit'          =>  (!empty($dr) ? $dr : 0),
            'Credit'         =>  (!empty($cr) ? $cr : 0),
            'IsPosted' => 1,
            'is_opening' => 1,
            'created_by' => auth()->user()->id,
            'created_at' => Carbon::now(),
            'location_id' => $this->location,
        ]);

        //Account Head Cash Transaction
        $this->transaction->create([
            'VNo' => $request->withdraw_deposit_id,
            'Vtype' => 'Bank Transaction',
            'VDate' => $request->date,
            'COAID'  =>  1020101,
            'Narration' => $request->remarks,
            'Debit'          =>  (!empty($cr) ? $cr : 0),
            'Credit'         =>  (!empty($dr) ? $dr : 0),
            'IsPosted' => 1,
            'is_opening' => 1,
            'created_by' => auth()->user()->id,
            'created_at' => Carbon::now(),
            'location_id' => $this->location,

        ]);

        return redirect()->route('bank.transaction');
    }

    public function ledger(Request $request)
    {
        $this->authorize('ledger', $this->model);

        $report = $this->transaction->whereHas('accountHead',function ($query){
            $query->where('PHeadName','Cash At Bank');
        });
        $report = $report->where('location_id', $this->location);
        $report =\QueryHelper::filterByDate($request,$report,'invoices','transactions') ;
        $ledger = $report->paginate(15);
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Bank' => route('dashboard.accounts.bank.index'),
            'Bank Ledger' => ''
        ]);

        $page_title = "Bank Ledger";

        return view('dashboard.accounts.Bank.bank_ledger',compact('page_title', 'breadcrumbs','ledger'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', $this->model);

        $bank = $this->model->where('location_id', $this->location)->get();
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Bank' => '',
        ]);

        $page_title = "Manage Bank";

        return view('dashboard.accounts.Bank.manage_bank', compact('page_title', 'breadcrumbs','bank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', $this->model);
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Bank' => route('dashboard.accounts.bank.index'),
            'Create New Bank' => ''
        ]);

        $page_title = "Create New Bank";
        return view('dashboard.accounts.Bank.add_new_bank', compact('page_title', 'breadcrumbs',));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', $this->model);
        $account_name = $this->accountHead->where('HeadName', $request->account_name)->get();
        if (count($account_name) < 1) {

            $this->makeDirectory('banks');
            $this->model = $this->model->create([
                'name' => $request->name,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'branch' => $request->branch,
                'location_id' => $this->location,
            ]);

            if ($request->file('signature_pic')) {
                $file = $request->file('signature_pic');
                $name = sha1('img' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->save(public_path('uploads/banks/') . $name);
                $this->model->signature_pic = 'uploads/banks/' . $name;
                $this->model->save();
            }

            $headCode = $this->headCode();

            if ($headCode != NULL) {
                $headCode = $headCode + 1;
            } else {
                $headCode = "102010201";
            }

            $this->accountHead->create([
                    'HeadCode' => $headCode,
                    'HeadName' => $request->account_name . " - ". $request->name,
                    'PHeadName' => 'Cash At Bank',
                    'HeadLevel' => '4',
                    'IsActive' => '1',
                    'IsTransaction' => '1',
                    'IsGL' => '0',
                    'HeadType' => 'A',
                    'IsBudget' => '0',
                    'IsDepreciation' => '1',
                    'DepreciationRate' => '1',
                    'location_id' => $this->location,
                ]);
        } else {

            echo "already account exists";
        }


        return redirect()->route('dashboard.accounts.bank.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('edit', $this->model);

        $bank = Bank::where('location_id', $this->location)->findorFail($id);
        return view('dashboard.accounts.Bank.Edit_bank', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('edit', $this->model);

        $this->model = $this->model->where('location_id', $this->location)->findorfail($id);
        $this->model->fill([
            'name' => $request->name,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'branch' => $request->branch,
            'signature_pic' => $path ?? "",
        ])->save();

        if ($request->file('signature_pic')) {
            $file = $request->file('signature_pic');
            $name = sha1('img' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $image->save(public_path('uploads/banks/') . $name);
            $this->model->signature_pic = 'uploads/banks/' . $name;
            $this->model->save();
        }

        return redirect()->route('dashboard.accounts.bank.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', $this->model);

        $bank = Bank::where('location_id', $this->location)->findorFail($id);
        $bank->delete();
        return redirect()->route('dashboard.accounts.bank.index');
    }

    private function headCode()
    {
        $headCode =
            AccountHead::where('HeadLevel', 4)
                ->where('HeadCode', 'like', '1020102' . '%')
                ->max('HeadCode');
        return $headCode;
    }
}
