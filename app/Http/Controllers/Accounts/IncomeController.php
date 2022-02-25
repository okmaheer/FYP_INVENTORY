<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\IncomeHead;
use App\Models\AccountHead;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Prefixes;

class IncomeController extends Controller
{

    public $model;
    public $incomeHead;
    public $accountHead;
    public $transaction;
    private $location;

    function __construct(Income $income,IncomeHead $incomeHead,AccountHead $accountHead,Transaction $transaction)
    {
        $this->middleware('auth');
        $this->model = $income;
        $this->incomeHead = $incomeHead;
        $this->accountHead = $accountHead;
        $this->transaction = $transaction;
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

    public function IncomeStatement(Request $request)
    {
        $this->authorize('statement', $this->model);

        $report = $this->model->where('location_id', $this->location);
        $report = \QueryHelper::filterByDate($request,$report,'incomes','incomes');

        if($request->has('income_head_child') &&
            is_numeric($request->get('income_head_child'))) {
                $report = $report->where('income_head',$request->income_head_child);

        } else {
            if($request->has('income_head') &&
                $request->get('income_head') != ''){

                $report = $report->where('income_head',$request->income_head);
                $sub_heads = $this->incomeHead->whereParentId($request->income_head)->get();
                if (count($sub_heads) > 0) {
                    foreach ($sub_heads as $sub_head) {
                        $report = $report->orWhere('income_head',$sub_head->id);
                    }
                }
            }
        }

        $statement = $report->orderBy('date', 'DESC')->get();

        $income_heads = $this->incomeHead->where('location_id', $this->location)->whereParentId(0)
            ->orderBy('income_head_name', 'ASC')->pluck('income_head_name', 'id');
        $income_head_child = $this->incomeHead->where('location_id', $this->location)->whereParentId($request->income_head)
            ->orderBy('income_head_name', 'ASC')->pluck('income_head_name', 'id');

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Income' => route('dashboard.accounts.income.index'),
            'Income Statement' => '',
        ]);

        $page_title = "Income Statement";

        return view('dashboard.accounts.Human-Resource.Income.income_statement',compact('page_title', 'breadcrumbs',
'page_title','statement','income_heads','income_head_child'));
    }

    public function index()
    {
        $this->authorize('view', $this->model);

        $page_title = __('accounts.income.income_list');
        $income = $this->model->where('location_id', $this->location)->get();

         $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Income' => '',

        ]);

        return view('dashboard.accounts.Human-Resource.Income.manage_income',compact('page_title', 'breadcrumbs','page_title','income'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', $this->model);

        $page_title = __('accounts.income.create_new_income');
        $incomeHeads = $this->incomeHead->where('location_id', $this->location)
            ->orderBy('income_head_name', 'ASC')->pluck('income_head_name','id');

        foreach($incomeHeads as $key => $incomeHead) {
            if ( $this->incomeHead->hasChilds($key) ) {
                $incomeHeads->forget($key);
            }
        }
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Income' => route('dashboard.accounts.income.index'),
            'Create New Income' => ''
        ]);


        return view('dashboard.accounts.Human-Resource.Income.add_income',compact('page_title', 'breadcrumbs','page_title','incomeHeads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', $this->model);

        $voucherNo = Prefixes::generateNumber('Income');

        $income_head = $request->income_head;
        $getIncomeHeadName = $this->incomeHead->getIncomeHeadName($income_head);
        $headName = $income_head."-".$getIncomeHeadName;
        $HeadCode = $this->accountHead->where('HeadName',$headName)->first()->HeadCode;
        $income_amount = $request->amount;

        $this->model = $this->model::create([
            'voucher_no' => $voucherNo,
            'date' => $request->date,
            'income_head' => $request->income_head,
            'payment_type' => $request->payment_type,
            'amount' => $request->amount,
            'description' => $request->description,
            'created_by' => auth()->user()->id,
            'location_id' => $this->location,
        ]);

        // income type debit
        $this->model->transactions()->save(
            new Transaction([
                'Vtype' => 'Income',
                'VDate' => $request->date,
                'COAID' => $HeadCode,
                'Narration' => $getIncomeHeadName.' Income '.$voucherNo,
                'Debit' => $income_amount,
                'Credit' => 0,
                'IsPosted' => 1,
                'created_by' => auth()->user()->id,
                'created_at' => Carbon::now(),
                'IsAppove' => 1,
                'location_id' => $this->location,
            ])
        );
        // cash in hand credit
        $this->model->transactions()->save(
            new Transaction([
                'Vtype' => 'Income',
                'VDate' => $request->date,
                'COAID' => 1020101,
                'Narration' => $getIncomeHeadName.' Income '.$voucherNo,
                'Debit' => $income_amount,
                'Credit' => 0,
                'IsPosted' => 1,
                'created_by' => auth()->user()->id,
                'created_at' => Carbon::now(),
                'IsAppove' => 1,
                'location_id' => $this->location,
            ])
        );

        Prefixes::updateNumber('Income');

        if ($request->doPrint == 1) {
            return redirect()->route('dashboard.accounts.income.show',$this->model->id)->with('page_title', 'Income Invoice');
        } else {
            return redirect()->route('dashboard.accounts.income.index')->with('success', trans('accounts.messages.created_income_msg'));
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
        $this->authorize('viewReceipt', $this->model);

        $page_title = "Income Receipt";
        $income = $this->model->where('location_id', $this->location)->findorFail($id);

        return view('dashboard.accounts.Human-Resource.Income.receipt', compact('income', 'page_title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('edit', $this->model);
        //$income = Income::where('id',$id)->first();
        //return view('dashboard.accounts.Human-Resource.Income.edit_income',compact('income'));
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
        $this->authorize('edit', $this->model);

        $income = Income::findorfail($id);
        $income->fill([
            'date' => $request->date,
            'income_type' => $request->income_type,
            'payeme_type' => $request->payeme_type,
            'amount' => $request->amount,
        ])->save();

        return redirect()->route('dashboard.accounts.income.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', $this->model);

        $income = $this->model->where('location_id', $this->location)->findorFail($id);
        $this->transaction->where('VNo',$income->voucher_no)->where('Vtype','Income')
            ->where('location_id', $this->location)->delete();
        $income->delete();

        return redirect()->route('dashboard.accounts.income.index')->with('success', trans('accounts.messages.deleted_income_msg'));
    }
}
