<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Prefixes;

class CustomerController extends Controller
{
    public $model;
    public $transaction;
    public $accountHead;
    private $location;

    function __construct(Customer $customer, Transaction $transaction, AccountHead $accountHead)
    {
        $this->middleware('auth');
        $this->model = $customer;
        $this->transaction = $transaction;
        $this->accountHead = $accountHead;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function creditCustomer()
    {
        $this->authorize('creditCustomer',$this->model);

        $customer = DB::table('customers as a')
            ->where('a.location_id', $this->location)
            ->leftJoin('account_heads as b', 'a.id', '=', 'b.customer_id')
            ->selectRaw("a.customer_name,a.customer_address,a.customer_mobile,a.customer_email,a.city,a.state,a.zip,a.country,b.HeadCode,((select ifnull(sum(Debit),0) from transactions where COAID= b.HeadCode)-(select ifnull(sum(Credit),0) from transactions where COAID= b.HeadCode)) as balance")
            ->havingRaw('balance > 0')
            ->groupBy('a.id', 'b.HeadCode', 'a.customer_name', 'a.customer_address', 'a.customer_mobile', 'a.customer_email', 'a.city', 'a.state', 'a.zip', 'a.country')
            ->orderBy('a.customer_name', 'asc')
            ->get();
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Customers' => route('dashboard.accounts.customer.index'),
            'Credit Customer' => ''
        ]);

        $page_title = "Credit Customer";

        return view('dashboard.accounts.customer.customer_credit', compact('page_title', 'breadcrumbs','customer'));
    }
    public function paidCustomer()
    {
        $this->authorize('paidCustomer',$this->model);

        $customer = DB::table('customers as a')
            ->where('a.location_id', $this->location)
            ->leftJoin('account_heads as b', 'a.id', '=', 'b.customer_id')
            ->selectRaw("a.customer_name,a.customer_address,a.customer_mobile,a.customer_email,a.city,a.state,a.zip,a.country,b.HeadCode,((select ifnull(sum(Debit),0) from transactions where COAID= b.HeadCode)-(select ifnull(sum(Credit),0) from transactions where COAID= b.HeadCode)) as balance")
            ->havingRaw('balance <= 0')
            ->groupBy('a.id', 'b.HeadCode', 'a.customer_name', 'a.customer_address', 'a.customer_mobile', 'a.customer_email', 'a.city', 'a.state', 'a.zip', 'a.country')
            ->orderBy('a.customer_name', 'asc')
            ->get();

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Customers' => route('dashboard.accounts.customer.index'),
            'Paid Customer' => ''
        ]);

        $page_title = "Paid Customer";

        return view('dashboard.accounts.customer.paid_customer', compact('page_title', 'breadcrumbs','customer'));
    }
    public function ledger(Request $request)
    {
        $this->authorize('ledger',$this->model);
        $customer_name = '';

        if ($request->has('customer_id') &&  $request->get('customer_id') != '') {

            $ledger = Transaction::whereHas('accountHead', function ($query) use ($request) {
                $query->where('customer_id', $request->customer_id);
            });
            $customer_name =  $this->model->find($request->customer_id)->customer_name;
        } else {
            $ledger = Transaction::whereHas('accountHead', function ($query) {
                $query->whereNotNull('customer_id');
            });
        }
        $ledger = $ledger->where('IsAppove', 1)->where('location_id', $this->location);
        $ledger = \QueryHelper::filterByDate($request,$ledger,'transaction-between','transactions');
        $ledger = $ledger->orderBy('VDate', 'DESC')->get();

        $customer = $this->model->orderBy('customer_name', 'ASC')->where('location_id', $this->location)->pluck('customer_name', 'id');
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Customers' => route('dashboard.accounts.customer.index'),
            'Customer Ledger' => ''
        ]);

        $page_title = "Customer Ledger" . (strlen($customer_name) ? (' - ' . $customer_name) : '');


        return view('dashboard.accounts.customer.customer_ledger', compact('page_title', 'breadcrumbs','ledger', 'customer', 'customer_name'));
    }
    public function customerAdvance()
    {
        $this->authorize('advance',$this->model);

        $customers = $this->model->orderBy('customer_name', 'ASC')->where('location_id', $this->location)->pluck('customer_name', 'id');
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Customers' => route('dashboard.accounts.customer.index'),
            'Customer Advance' => ''
        ]);

        $page_title = "Customer Advance";
        return view('dashboard.accounts.customer.customer_advance', compact('page_title', 'breadcrumbs','customers'));
    }
    public function addCustomerAdvance(Request $request)
    {
        $this->authorize('advance',$this->model);
        $todayDate = Carbon::today()->toDateString();
        if ($request->advance_type == 1) {
            $dr = $request->amount;
            $tp = 'd';
        } else {
            $cr = $request->amount;
            $tp = 'c';
        }
        /* $transactionId = \AccountHelper::generator(10); */
        $transactionId  = Prefixes::generateNumber('Advance');

        $headcode   = $this->accountHead->where('customer_id', $request->customer_id)->value('HeadCode');
        $customerName = $this->model->getCustomerName($request->customer_id);

        //customer Account Ledger
        $this->transaction->create([
            'VNo'            => $transactionId,
            'Vtype'          => 'Advance',
            'VDate'          => $todayDate,
            'COAID'          => $headcode,
            'Narration'      => 'Customer Advance For  ' . $customerName,
            'Debit'          => (!empty($dr) ? $dr : 0),
            'Credit'         => (!empty($cr) ? $cr : 0),
            'IsPosted'       => 1,
            'is_opening'     => 1,
            'created_by'     => auth()->user()->id,
            'created_at'     => $todayDate,
            'IsAppove'       => 1,
            'location_id'    => $this->location,
        ]);

        //Cash in Hand
        $this->transaction->create([
            'VNo'            => $transactionId,
            'Vtype'          => 'Advance',
            'VDate'          => $todayDate,
            'COAID'          => 1020101,
            'Narration'      => 'Cash in Hand For Customer ' . $customerName . ' Advance',
            'Debit'          => (!empty($dr) ? $dr : 0),
            'Credit'         => (!empty($cr) ? $cr : 0),
            'IsPosted'       => 1,
            'is_opening'     => 1,
            'created_by'     => auth()->user()->id,
            'created_at'     => $todayDate,
            'IsAppove'       => 1,
            'location_id'    => $this->location,
        ]);
        Prefixes::updateNumber('Advance');
        return redirect()->route('customer.ledger');
    }

    public function index(Request $request)
    {
        $this->authorize('view',$this->model);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Customers' => '',
        ]);
        $page_title = "Manage Customers";

        $customer = $this->model->where('location_id', $this->location);

        if ($request->has('customer_name') &&  is_numeric($request->get('customer_name')) ) {
            $customer = $customer->where('id', $request->customer_name);
        }

        if ($request->has('customer_cnic') &&  is_numeric($request->get('customer_cnic')) ) {
            $customer = $customer->where('id', $request->customer_cnic);
        }

        if ($request->has('customer_mobile') &&  is_numeric($request->get('customer_mobile')) ) {
            $customer = $customer->where('id', $request->customer_mobile);
        }

        if ($request->has('customer_city') &&  is_numeric($request->get('customer_city')) ) {
            $customer = $customer->where('id', $request->customer_city);
        }

        $customer = $customer->get();

        $filter_customer_name = $this->model->orderBy('customer_name', 'ASC')->where('location_id', $this->location)->pluck('customer_name', 'id');
        $filter_customer_cnic = $this->model->orderBy('cnic', 'ASC')->where('location_id', $this->location)->pluck('cnic', 'id');
        $filter_customer_mobile = $this->model->orderBy('customer_mobile', 'ASC')->where('location_id', $this->location)->pluck('customer_mobile', 'id');
        $filter_customer_city = $this->model->orderBy('city', 'ASC')->where('location_id', $this->location)->pluck('city', 'id');

        return view('dashboard.accounts.customer.customer_table', compact('customer', 'page_title', 'breadcrumbs', 'filter_customer_mobile', 'filter_customer_cnic', 'filter_customer_name', 'filter_customer_city'));
    }

    public function create()
    {
        $this->authorize('create',$this->model);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Customers' => route('dashboard.accounts.customer.index'),
            'Create New Customer' => ''
        ]);

        $page_title = "Create New Customer";

        return view('dashboard.accounts.customer.add_customer', compact('page_title', 'breadcrumbs'));
    }

    public function store(Request $request)
    {
        $this->authorize('create',$this->model);

        $customer = Customer::create([
            'customer_name' => $request->customer_name ,
            'customer_mobile' => $request->customer_mobile ,
            'customer_email' => $request->customer_email ,
            'cnic' => $request->cnic ,
            'phone' => $request->phone ,
            'contact' => $request->contact ,
            'customer_address' => $request->customer_address ,
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
        $headName = $customer->headName();

        if ($headCode != NULL) {
            $headCode = $headCode + 1;
        } else {
            $headCode = "10203010001";
        }

        $customer->accountHead()->save(
            new AccountHead([
                'HeadCode'         => $headCode,
                'HeadName'         => $headName,
                'PHeadName'        => 'Customer Receivable',
                'HeadLevel'        => '4',
                'IsActive'         => '1',
                'IsTransaction'    => '1',
                'IsGL'             => '0',
                'HeadType'         => 'A',
                'IsBudget'         => '0',
                'IsDepreciation'   => '0',
                'DepreciationRate' => '0',
                'location_id'      => $this->location,
            ])
        );

        if ($request->has('previous_balance') && $request->get('previous_balance') != "") {
            $balance = $request->previous_balance;
            $customerName = $this->model->getCustomerName($customer->id);
            $this->previousBalanceAdd($balance, $headCode, $customerName);
        }

        return redirect()->route('dashboard.accounts.customer.index')->with('success', trans('accounts.messages.created_customer_msg'));
    }

    public function show($id)
    {
        $this->authorize('show',$this->model);
    }

    public function edit($id)
    {
        $this->authorize('edit',$this->model);

        $customer = Customer::where('location_id', $this->location)->findorFail($id);
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Customers' => route('dashboard.accounts.customer.index'),
            'Modify Customer' => ''
        ]);

        $page_title = "Modify Customer";
        return view('dashboard.accounts.customer.edit_customer', compact('page_title', 'breadcrumbs','customer', 'page_title', 'breadcrumbs'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit',$this->model);

        $customer = Customer::where('location_id', $this->location)->findorFail($id);
        $customer->fill([
            'customer_name' => $request->customer_name ,
            'customer_mobile' => $request->customer_mobile ,
            'customer_email' => $request->customer_email ,
            'cnic' => $request->cnic ,
            'phone' => $request->phone ,
            'contact' => $request->contact ,
            'customer_address' => $request->customer_address ,
            'address2' => $request->address2 ,
            'fax' => $request->fax ,
            'city' => $request->city ,
            'state' => $request->state ,
            'zip' => $request->zip ,
            'country' => $request->country ,
        ])->save();


        return redirect()->route('dashboard.accounts.customer.index')->with('success', trans('accounts.messages.updated_customer_msg'));
    }

    public function destroy($id)
    {
        $this->authorize('delete',$this->model);

        $customer = Customer::where('location_id', $this->location)->findorFail($id);
        $customer->delete();

        return redirect()->route('dashboard.accounts.customer.index')->with('success', trans('accounts.messages.deleted_customer_msg'));
    }

    private function headCode()
    {
        $headCode =
            AccountHead::where('HeadLevel', 4)
            ->where('HeadCode', 'like',  '1020301' . '%')
            ->max('HeadCode');
        return $headCode;
    }

    private function previousBalanceAdd($balance, $headCode, $customerName)
    {
        $transactionId = Prefixes::generateNumber('PR Balance');

        // Customer debit for previous balance
        $this->transaction->create([
            'VNo'            => $transactionId,
            'Vtype'          => 'PR Balance',
            'VDate'          => Carbon::now(),
            'COAID'          => $headCode,
            'Narration'      => 'Customer ' . $customerName . ' Previous Balance Debit',
            'Debit'          =>  $balance,
            'Credit'         =>  0,
            'IsPosted'       => 1,
            'is_opening'     => 1,
            'created_by'     => auth()->user()->id,
            'created_at'     => Carbon::now(),
            'IsAppove'       => 1,
            'location_id'    => $this->location,
        ]);

        //inventory
        $this->transaction->create([
            'VNo'            => $transactionId,
            'Vtype'          => 'PR Balance',
            'VDate'          => Carbon::now(),
            'COAID'          => 10107,
            'Narration'      => 'Inventory Credit for Old Sales of Customer ' . $customerName,
            'Debit'          =>  0,
            'Credit'         =>  $balance, //purchase price asbe
            'IsPosted'       => 1,
            'is_opening'     => 1,
            'created_by'     => auth()->user()->id,
            'created_at'     => Carbon::now(),
            'IsAppove'       => 1,
            'location_id'    => $this->location,
        ]);

        Prefixes::updateNumber('PR Balance');
    }

    public function customerAddAjax(Request $request)
    {
        $output = ['success' => false, 'msg' => ''];
        if (Auth::user()->can('create', $this->model)) {

            DB::beginTransaction();
            try {
                $customer = $this->model->create($request->all());
                $customer->created_by = auth()->user()->id;
                $customer->location_id = $this->location;
                $customer->save();

                $headCode = $this->headCode();
                $headName = $customer->headName();

                if ($headCode != NULL) {
                    $headCode = $headCode + 1;
                } else {
                    $headCode = "10203010001";
                }

                $customer->accountHead()->save(
                    new AccountHead([
                        'HeadCode' => $headCode,
                        'HeadName' => $headName,
                        'PHeadName' => 'Customer Receivable',
                        'HeadLevel' => '4',
                        'IsActive' => '1',
                        'IsTransaction' => '1',
                        'IsGL' => '0',
                        'HeadType' => 'A',
                        'IsBudget' => '0',
                        'IsDepreciation' => '0',
                        'depreciation_rate' => '0',
                        'location_id' => $this->location,
                    ])
                );

                if ($request->has('previous_balance') && $request->get('previous_balance') != "") {
                    $balance = $request->previous_balance;
                    $customerName = $this->model->getCustomerName($customer->id);
                    $this->previousBalanceAdd($balance, $headCode, $customerName);
                }

                DB::commit();
                $output = ['success' => true, 'msg' => 'Customer created successfully!', 'customer' => $customer];
            } catch (\Exception $e) {
                DB::rollback();
                $output = ['success' => false, 'msg' => $e->getMessage()];
            }

        } else {
            $output['msg'] = 'You are not allowed to perform this action.';
        }
        return $output;
    }

    public function ApiCustomerBalance(Request $request) {
        $customer_balance = 0;
        if ($request->ajax()) {
            $customer = $this->model->where('location_id', $this->location)->findorFail($request->customerID);
            if ($customer) {
                $customer_accountHead = $customer->accountHead()->first();

                $headCode = $customer_accountHead->HeadCode;
                $headName = $customer_accountHead->HeadName;

                $query  = $this->transaction
                    ->selectRaw('sum(transactions.Debit) as predebit, sum(transactions.Credit) as precredit')
                    ->where('transactions.IsAppove',1)
                    ->where('transactions.COAID',$headCode)
                    ->first();

                $temp_bal = $query->predebit - $query->precredit;
                $customer_balance += (!empty($temp_bal)?$temp_bal:0);

                $balance = $customer_balance > 0 ? (\AccountHelper::number_format($customer_balance) . "<small> DR</small>") : (\AccountHelper::number_format($customer_balance * -1) . "<small> CR</small>");

                $last_transaction = $this->transaction::where('COAID', $headCode)
                    ->where('Credit', '>', 0)
                    ->orderBy('created_at', 'DESC')
                    ->first();

                if ($last_transaction) {
                    $last = \AccountHelper::number_format($last_transaction->Credit);
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
