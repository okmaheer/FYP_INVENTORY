<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use App\Models\Prefixes;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public $model;
    public $transaction;
    public $accountHead;
    private $location;

    function __construct(Supplier $supplier,Transaction $transaction,AccountHead $accountHead)
    {
        $this->middleware('auth');
        $this->model = $supplier;
        $this->transaction = $transaction;
        $this->accountHead = $accountHead;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function ledger(Request $request)
    {
        $this->authorize('ledger', $this->model);

        $supplier_name = '';

        if ($request->has('supplier_id') &&  $request->get('supplier_id') != '') {
            $ledger = Transaction::whereHas('accountHead', function ($query) use ($request){
                $query->where('supplier_id',$request->supplier_id);
            });
            $supplier_name = $this->model->find($request->supplier_id)->supplier_name;
        }
        else{
            $ledger = Transaction::whereHas('accountHead', function ($query) {
                $query->whereNotNull('supplier_id');
            });
        }
        $ledger = $ledger->where('IsAppove', 1)->where('location_id', $this->location);
        $ledger = \QueryHelper::filterByDate($request,$ledger,'transaction-between','transactions');
        $ledger = $ledger->orderBy('VDate', 'DESC')->get();

        $supplier = $this->model->orderBy('supplier_name', 'ASC')->where('location_id', $this->location)->pluck('supplier_name','id');
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Suppliers' => route('dashboard.accounts.supplier.index'),
            'Supplier Ledger' => ''
        ]);

        $page_title = "Supplier Ledger";
        return view('dashboard.accounts.supplier.supplier_ledger',compact('page_title', 'breadcrumbs','ledger','supplier', 'supplier_name'));
    }
    public function supplierAdvance() {
        $this->authorize('advance', $this->model);

        $suppliers = $this->model->orderBy('supplier_name', 'ASC')->where('location_id', $this->location)->pluck('supplier_name','id');
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Suppliers' => route('dashboard.accounts.supplier.index'),
            'Supplier Advance' => ''
        ]);

        $page_title = "Supplier Advance";

        return view('dashboard.accounts.supplier.supplier_advance',compact('page_title', 'breadcrumbs','suppliers'));
    }

    public function addSupplierAdvance(Request $request){
        $this->authorize('advance', $this->model);

        $todayDate = Carbon::today()->toDateString();
        if ($request->advance_type == 1){
            $dr = $request->amount;
            $tp = 'd';
        }
        else{
            $cr = $request->amount;
            $tp = 'c';
        }
        /* $transactionId = \AccountHelper::generator(10); */
        $transactionId  = Prefixes::generateNumber('Advance');
        $headcode   = $this->accountHead->where('supplier_id',$request->supplier_id)->value('HeadCode');
        $supplierName = $this->model->getSupplierName($request->supplier_id);

        //supplier Account Ledger
        $this->transaction->create([
            'VNo'            => $transactionId,
            'Vtype'          => 'Advance',
            'VDate'          => $todayDate,
            'COAID'          => $headcode,
            'Narration'      => 'supplier Advance For  '.$supplierName,
            'Debit'          =>  (!empty($dr)?$dr:0),
            'Credit'         =>  (!empty($cr)?$cr:0),
            'IsPosted'       => 1,
            'is_opening'     => 1,
            'created_by'     => auth()->user()->id,
            'created_at'     => $todayDate,
            'IsAppove'       => 1,
            'location_id'       => $this->location,
        ]);

        //Cash In Hand
        $this->transaction->create([
            'VNo'            => $transactionId,
            'Vtype'          => 'Advance',
            'VDate'          => $todayDate,
            'COAID'          => 1020101,
            'Narration'      => 'Cash in Hand  For '.$supplierName.' Advance',
            'Debit'          =>  (!empty($dr)?$dr:0),
            'Credit'         =>  (!empty($cr)?$cr:0),
            'IsPosted'       => 1,
            'is_opening'     => 1,
            'created_by'       => Auth::id(),
            'created_at'     => $todayDate,
            'IsAppove'       => 1,
            'location_id'       => $this->location
        ]);
        Prefixes::updateNumber('Advance');
        return redirect()->route('supplier.ledger');

    }

    public function index(Request $request)
    {
         $this->authorize('view', $this->model);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Suppliers' => '',
        ]);
        $page_title = "Manage Suppliers";

        $supplier = $this->model->where('location_id', $this->location);

        if ($request->has('supplier_name') &&  is_numeric($request->get('supplier_name')) ) {
            $supplier = $supplier->where('id', $request->supplier_name);
        }

        if ($request->has('supplier_cnic') &&  is_numeric($request->get('supplier_cnic')) ) {
            $supplier = $supplier->where('id', $request->supplier_cnic);
        }

        if ($request->has('supplier_mobile') &&  is_numeric($request->get('supplier_mobile')) ) {
            $supplier = $supplier->where('id', $request->supplier_mobile);
        }

        $supplier = $supplier->get();

        $filter_supplier_name = $this->model::orderBy('supplier_name', 'ASC')->where('location_id', $this->location)->pluck('supplier_name', 'id');
        $filter_supplier_cnic = $this->model::orderBy('cnic', 'ASC')->where('location_id', $this->location)->pluck('cnic', 'id');
        $filter_supplier_mobile = $this->model::orderBy('supplier_mobile', 'ASC')->where('location_id', $this->location)->pluck('supplier_mobile', 'id');

        return view('dashboard.accounts.supplier.supplier_table',compact('supplier', 'page_title','breadcrumbs', 'filter_supplier_mobile', 'filter_supplier_cnic', 'filter_supplier_name'));
    }

    public function create()
    {
        $this->authorize('create', $this->model);
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Suppliers' => route('dashboard.accounts.supplier.index'),
            'Create New Supplier' => ''
        ]);

        $page_title = "Create New Supplier";
        return view('dashboard.accounts.supplier.add_supplier', compact('page_title', 'breadcrumbs'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', $this->model);

        $request->validate([
            'supplier_name' => 'required',
            'supplier_mobile' => 'required',
            'cnic' => 'required|unique:suppliers,cnic'
        ]);

        $supplier = Supplier::create([
            'supplier_name' => $request->supplier_name ,
            'supplier_mobile' => $request->supplier_mobile ,
            'supplier_email' => $request->supplier_email ,
            'cnic' => $request->cnic ,
            'phone' => $request->phone ,
            'contact' => $request->contact ,
            'supplier_address' => $request->supplier_address ,
            'address2' => $request->address2 ,
            'fax' => $request->fax ,
            'city' => $request->city ,
            'state' => $request->state ,
            'zip' => $request->zip ,
            'country' => $request->country ,
            'previous_balance' => $request->previous_balance ,
            'location_id' => $this->location,
        ]);

        $headCode = $this->headCode();
        $headName = $supplier->headName();

        if($headCode!=NULL){
            $headCode=$headCode+1;
        }else{
            $headCode="502020001";
        }

        $supplier->accountHead()->save(
            new AccountHead([
                'HeadCode'         => $headCode,
                'HeadName'         => $headName,
                'PHeadName'        => 'Account Payable',
                'HeadLevel'        => '3',
                'IsActive'         => '1',
                'IsTransaction'    => '1',
                'IsGL'             => '0',
                'HeadType'         => 'L',
                'IsBudget'         => '0',
                'IsDepreciation'   => '0',
                'DepreciationRate' => '0',
                'location_id'      => $this->location,
            ])
        );

        if($request->has('previous_balance') && $request->get('previous_balance') != ""){
            $balance = $request->previous_balance;
            $supplierName = $this->model->getSupplierName($supplier->id);
            $this->previousBalanceAdd($balance,$headCode,$supplierName);
        }

        return redirect()->route('dashboard.accounts.supplier.index')->with('success', trans('accounts.messages.created_supplier_msg'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->authorize('edit', $this->model);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Suppliers' => route('dashboard.accounts.supplier.index'),
            'Modify Supplier' => ''
        ]);

        $page_title = "Modify Supplier";

        $supplier = Supplier::where('location_id', $this->location)->findorFail($id);
        return view('dashboard.accounts.supplier.edit_supplier',compact('supplier', 'page_title', 'breadcrumbs'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit', $this->model);

        $request->validate([
            'supplier_name' => 'required',
            'supplier_mobile' => 'required',
            'cnic' => 'required|unique:suppliers,cnic,' . $id
        ]);

        $supplier = Supplier::where('location_id', $this->location)->findorfail($id);
        $supplier->fill([
            'supplier_name' => $request->supplier_name ,
            'supplier_mobile' => $request->supplier_mobile ,
            'supplier_email' => $request->supplier_email ,
            'cnic' => $request->cnic ,
            'phone' => $request->phone ,
            'contact' => $request->contact ,
            'supplier_address' => $request->supplier_address ,
            'address2' => $request->address2 ,
            'fax' => $request->fax ,
            'city' => $request->city ,
            'state' => $request->state ,
            'zip' => $request->zip ,
            'country' => $request->country ,
        ])->save();

        return redirect()->route('dashboard.accounts.supplier.index')->with('success', trans('accounts.messages.updated_supplier_msg'));
    }

    public function destroy($id)
    {
        $this->authorize('delete', $this->model);
        $supplier = Supplier::where('location_id', $this->location)->findorFail($id);
        $supplier->delete();

        return redirect()->route('dashboard.accounts.supplier.index')->with('success', trans('accounts.messages.deleted_supplier_msg'));
    }

    private function headCode(){
        $headCode =
            AccountHead::where('HeadLevel',3)
                ->where('HeadCode', 'like',  '50202' . '%')
                ->max('HeadCode');
        return $headCode;
    }

    private function previousBalanceAdd($balance,$headCode,$supplierName){
        $transactionId = Prefixes::generateNumber('PR Balance');

        //supplier debit for previous balance
        $this->transaction->create([
            'VNo'            => $transactionId,
            'Vtype'          => 'PR Balance',
            'VDate'          => Carbon::now(),
            'COAID'          => $headCode,
            'Narration'      => 'Supplier ' . $supplierName . ' Debit For Previous Purchases',
            'Debit'          =>  $balance,
            'Credit'         =>  0,
            'IsPosted'       => 1,
            'is_opening'     => 1,
            'created_by'     => auth()->user()->id,
            'created_at'     => Carbon::now(),
            'IsAppove'       => 1,
            'location_id'    => $this->location,
        ]);

        //inventory credit
        $this->transaction->create([
            'VNo'            => $transactionId,
            'Vtype'          => 'PR Balance',
            'VDate'          => Carbon::now(),
            'COAID'          => 10107,
            'Narration'      => 'Inventory Credit for Old Purchases of '.$supplierName,
            'Debit'          =>  0,
            'Credit'         =>  $balance,//purchase price asbe
            'IsPosted'       => 1,
            'is_opening'     => 1,
            'created_by'     => auth()->user()->id,
            'created_at'     => Carbon::now(),
            'IsAppove'       => 1,
            'location_id'    => $this->location,
        ]);
        Prefixes::updateNumber('PR Balance');
    }

    public function supplierAddAjax(Request $request){
        $output = ['success' => false, 'msg' => ''];
        if (Auth::user()->can('create', $this->model)) {
            DB::beginTransaction();

            try {
                $request->validate([
                    'supplier_name' => 'required',
                    'supplier_mobile' => 'required',
                    'cnic' => 'required|unique:suppliers,cnic'
                ]);

                $supplier = $this->model->create($request->all());
                $supplier->created_by = auth()->user()->id;
                $supplier->location_id = $this->location;
                $supplier->save();

                $headCode = $this->headCode();
                $headName = $supplier->headName();

                if ($headCode != NULL) {
                    $headCode = $headCode + 1;
                } else {
                    $headCode = "502020001";
                }

                $supplier->accountHead()->save(
                    new AccountHead([
                        'HeadCode' => $headCode,
                        'HeadName' => $headName,
                        'PHeadName' => 'Account Payable',
                        'HeadLevel' => '3',
                        'IsActive' => '1',
                        'IsTransaction' => '1',
                        'IsGL' => '0',
                        'HeadType' => 'L',
                        'IsBudget' => '0',
                        'IsDepreciation' => '0',
                        'DepreciationRate' => '0',
                        'location_id' => $this->location,
                    ])
                );

                if ($request->has('previous_balance') && $request->get('previous_balance') != "") {
                    $balance = $request->previous_balance;
                    $supplierName = $this->model->getSupplierName($supplier->id);
                    $this->previousBalanceAdd($balance, $headCode, $supplierName);
                }
                DB::commit();
                $output = ['success' => true, 'msg' => 'Supplier created successfully!', 'supplier' => $supplier];
            } catch (\Exception $e) {
                DB::rollback();
                $output = ['success' => false, 'msg' => $e->getMessage()];
            }
        } else {
            $output['msg'] = 'You are not allowed to perform this action.';
        }
        return $output;
    }

    public function ApiSupplierBalance(Request $request) {
        $supplier_balance = 0;
        if ($request->ajax()) {
            $supplier = $this->model->where('location_id', $this->location)->findorFail($request->supplierID);
            if ($supplier) {
                $supplier_accountHead = $supplier->accountHead()->first();

                $headCode = $supplier_accountHead->HeadCode;
                $headName = $supplier_accountHead->HeadName;

                $query  = $this->transaction
                    ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                    ->where('transactions.IsAppove',1)
                    ->where('transactions.COAID',$headCode)
                    ->first();

                $temp_bal = $query->predebit - $query->precredit;
                $supplier_balance += (!empty($temp_bal)?$temp_bal:0);

                $balance = $supplier_balance > 0 ? (\AccountHelper::number_format($supplier_balance) . "<small> DR</small>") : (\AccountHelper::number_format($supplier_balance * -1) . "<small> CR</small>");

                $last_transaction = $this->transaction::where('COAID', $headCode)
                                                        ->where('Debit', '>', 0)
                                                        ->orderBy('created_at', 'DESC')
                                                        ->first();

                if ($last_transaction) {
                    $last = \AccountHelper::number_format($last_transaction->Debit);
                } else {
                    $last = '0.00';
                }
                $output = ['success' => true,
                        'msg' => '', 'balance' => $balance, 'last' => $last
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
}
