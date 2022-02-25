<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PettyCash;
use Illuminate\Support\Facades\Auth;
use App\Models\Prefixes;

class PettyCashController extends Controller
{
    public $model;
    public $transaction;
    public $accountHead;
    private $location;

    function __construct(PettyCash $pettycash,Transaction $transaction,AccountHead $accountHead)
    {
        $this->middleware('auth');
        $this->model = $pettycash;
        $this->transaction = $transaction;
        $this->accountHead = $accountHead;
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

    public function ledger(Request $request)
    {
        $this->authorize('ledger', $this->model);

        $ledger = Transaction::whereHas('accountHead', function ($query) use ($request){
            if ($request->has('pettycash_id') &&  $request->get('pettycash_id') != '') {
                $query->where('pettycash_id', $request->pettycash_id);
            } else {
                $query->whereNotNull('pettycash_id');
            }
        });

        $ledger = \QueryHelper::filterByDate($request,$ledger,'transaction-between','transactions');
        $ledger = $ledger->where('IsAppove', 1)
            ->where('location_id', $this->location)->orderBy('VDate', 'DESC')->get();

        $pettycash = $this->accountHead->whereHas('pettycash', function($query) {
            if (auth()->user()->id > 1) {
                $query->where('id', auth()->user()->id);
            }
        })->pluck('HeadName', 'pettycash_id');

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'PettyCash Ledger' => ''
        ]);

        $page_title = "PettyCash Ledger";
        return view('dashboard.accounts.PettyCash.pettycash_ledger',compact('page_title', 'breadcrumbs','ledger','pettycash'));
    }

    public function index(Request $request)
    {
        abort(404);
        // $this->authorize('view', Pettycash::class);
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Pettycashs' => '',
        ]);
        $page_title = "Manage PettyCashs";

        $pettycash = $this->model;

        if ($request->has('pettycash_name') &&  is_numeric($request->get('pettycash_name')) ) {
            $pettycash = $pettycash->where('id', $request->pettycash_name);
        }

        if ($request->has('pettycash_cnic') &&  is_numeric($request->get('pettycash_cnic')) ) {
            $pettycash = $pettycash->where('id', $request->pettycash_cnic);
        }

        if ($request->has('pettycash_mobile') &&  is_numeric($request->get('pettycash_mobile')) ) {
            $pettycash = $pettycash->where('id', $request->pettycash_mobile);
        }

        $pettycash = $pettycash->get();

        $filter_pettycash_name = $this->model::orderBy('pettycash_name', 'ASC')->pluck('pettycash_name', 'id');
        $filter_pettycash_cnic = $this->model::orderBy('cnic', 'ASC')->pluck('cnic', 'id');
        $filter_pettycash_mobile = $this->model::orderBy('pettycash_mobile', 'ASC')->pluck('pettycash_mobile', 'id');

        return view('dashboard.accounts.PettyCash.pettycash_table',compact('pettycash', 'page_title','breadcrumbs', 'filter_pettycash_mobile', 'filter_pettycash_cnic', 'filter_pettycash_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
        // $this->authorize('a');
            $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'PettyCashs' => route('dashboard.accounts.pettycash.index'),
            'Create New PettyCash' => ''
        ]);

        $page_title = "Create New PettyCash";
        return view('dashboard.accounts.PettyCash.add_pettycash', compact('page_title', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(404);
        // $this->authorize('create', pettycash::class);

        $request->validate([
            'pettycash_name' => 'required',
            'pettycash_mobile' => 'required',

        ]);

        $pettycash = PettyCash::create([
            'pettycash_name' => $request->pettycash_name ,
            'pettycash_mobile' => $request->pettycash_mobile ,
            'pettycash_email' => $request->pettycash_email ,
            'cnic' => $request->cnic ,
            'phone' => $request->phone ,
            'contact' => $request->contact ,
            'pettycash_address' => $request->pettycash_address ,
            'address2' => $request->address2 ,
            'fax' => $request->fax ,
            'city' => $request->city ,
            'state' => $request->state ,
            'zip' => $request->zip ,
            'country' => $request->country ,
            'previous_balance' => $request->previous_balance ,

        ]);

        $headCode = $this->headCode();
        $headName = $pettycash->headName();

        if ($headCode != NULL) {
            $headCode = $headCode + 1;
        } else {
            $headCode = "107010201";
        }

         $pettycash->accountHead()->save(
             new AccountHead([
                 'HeadCode'         => $headCode,
                 'HeadName'         => $headName,
                 'PHeadName'        => 'Cash In Hand',
                 'HeadLevel'        => '4',
                 'IsActive' => '1',
                 'IsTransaction' => '1',
                 'IsGL' => '0',
                 'HeadType' => 'A',
                 'IsBudget' => '0',
                 'IsDepreciation' => '1',
                 'DepreciationRate' => '1',
             ])
         );

        if($request->has('previous_balance') && $request->get('previous_balance') != ""){
            $balance = $request->previous_balance;
            $pettycashName = $this->model->getPettycashName($pettycash->id);
            $this->previousBalanceAdd($balance,$headCode,$pettycashName);
        }

        return redirect()->route('dashboard.accounts.pettycash.index')->with('success', trans('accounts.messages.created_pettycash_msg'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(404);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'PettyCashs' => route('dashboard.accounts.pettycash.index'),
            'Modify PettyCashs' => ''
        ]);

        $page_title = "Modify PettyCashs";

        $pettycash = PettyCash::find($id);
        return view('dashboard.accounts.PettyCash.edit_pettycash',compact('pettycash', 'page_title', 'breadcrumbs'));
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
        abort(404);

        $request->validate([
            'pettycash_name' => 'required',
            'pettycash_mobile' => 'required',

        ]);

        $pettycash = PettyCash::findorfail($id);
        $pettycash->fill([
            'pettycash_name' => $request->pettycash_name ,
            'pettycash_mobile' => $request->pettycash_mobile ,
            'pettycash_email' => $request->pettycash_email ,
            'cnic' => $request->cnic ,
            'phone' => $request->phone ,
            'contact' => $request->contact ,
            'pettycash_address' => $request->pettycash_address ,
            'address2' => $request->address2 ,
            'fax' => $request->fax ,
            'city' => $request->city ,
            'state' => $request->state ,
            'zip' => $request->zip ,
            'country' => $request->country ,
            'previous_balance' => $request->previous_balance ,
        ])->save();

        return redirect()->route('dashboard.accounts.pettycash.index')->with('success', trans('accounts.messages.updated_pettycash_msg'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
        $pettycash = PettyCash::findorfail($id);
        $pettycash->delete();
        return redirect()->route('dashboard.accounts.pettycash.index')->with('success', trans('accounts.messages.deleted_pettycash_msg'));
    }
    private function headCode(){
        $headCode =
            AccountHead::where('HeadLevel',4)
                ->where('HeadCode', 'like',  '1070' . '%')
                ->max('HeadCode');
        return $headCode;
    }
}
