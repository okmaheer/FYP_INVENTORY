<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseHead;
use App\Models\AccountHead;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Prefixes;
use App\Traits\General;
use Intervention\Image\Facades\Image;

class ExpenseController extends Controller
{
    use General;

    public $model;
    public $expenseHead;
    public $accountHead;
    public $transaction;
    private $location;

    function __construct(Expense $expense,ExpenseHead $expenseHead,AccountHead $accountHead,Transaction $transaction)
    {
        $this->middleware('auth');
        $this->model = $expense;
        $this->expenseHead = $expenseHead;
        $this->accountHead = $accountHead;
        $this->transaction = $transaction;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function ExpenseStatement(Request $request)
    {
        $this->authorize('statement', $this->model);

        $report = $this->model->where('location_id', $this->location);
        $report = \QueryHelper::filterByDate($request,$report,'expenses','expenses');

        if($request->has('expense_head_child') &&
            is_numeric($request->get('expense_head_child'))) {
                $report = $report->where('expense_head',$request->expense_head_child);

        } else {
            if($request->has('expense_head') &&
                $request->get('expense_head') != ''){

                $report = $report->where('expense_head',$request->expense_head);
                $sub_heads = $this->expenseHead->whereParentId($request->expense_head)->get();
                if (count($sub_heads) > 0) {
                    foreach ($sub_heads as $sub_head) {
                        $report = $report->orWhere('expense_head',$sub_head->id);
                    }
                }
            }
        }

        $statement = $report->orderBy('date', 'DESC')->get();

        $expense_heads = $this->expenseHead->where('location_id', $this->location)->whereParentId(0)
            ->orderBy('expense_head_name', 'ASC')->pluck('expense_head_name','id');
        $expense_head_child = $this->expenseHead->where('location_id', $this->location)->whereParentId($request->expense_head)
            ->orderBy('expense_head_name', 'ASC')->pluck('expense_head_name','id');

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Expense' => route('dashboard.accounts.expense.index'),
            'Expense Statement' => '',
        ]);

        $page_title = "Expense Statement";

        return view('dashboard.accounts.Human-Resource.Expense.expense_statement',compact('page_title', 'breadcrumbs','statement','expense_heads','expense_head_child'));
    }

    public function index()
    {
        $this->authorize('view', $this->model);

        $page_title = __('accounts.expense.expense_list');
        $expense = $this->model->where('location_id', $this->location)
            ->orderBy('date', 'DESC')->get();

         $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Expense' => '',

        ]);

        return view('dashboard.accounts.Human-Resource.Expense.manage_expense',compact('page_title', 'breadcrumbs','expense'));
    }

    public function create()
    {
        $this->authorize('create', $this->model);

        $page_title = __('accounts.expense.create_new_expense');
        $heads = $this->expenseHead->where('location_id', $this->location)
            ->with('parent')
            ->orderBy('expense_head_name', 'ASC')->get();

        $expenseHeads = [];
        foreach($heads as $key => $expenseHead) {
            if ($expenseHead->parent()->exists()) {
                $expenseHeads[$expenseHead->parent->expense_head_name][$expenseHead->id] = $expenseHead->expense_head_name;
            } else {
                if (!$expenseHead->hasChilds($expenseHead->id)) {
                    $expenseHeads['General'][$expenseHead->id] = $expenseHead->expense_head_name;
                }
            }
        }

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Expense' => route('dashboard.accounts.expense.index'),
            'Create New Expense' => ''
        ]);

        $pettyCashAccounts = $this->accountHead->whereHas('pettycash', function($query) {
            if (auth()->user()->id > 1) {
                $query->where('id', auth()->user()->id);
            }
        })->orWhere('HeadCode', 'like', 102010 . '%')->where('HeadCode', '!=', 1020102)->pluck('HeadName','id');

        return view('dashboard.accounts.Human-Resource.Expense.add_expense',compact('page_title', 'breadcrumbs','expenseHeads','pettyCashAccounts'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', $this->model);

        $request->validate([
            'attachment' => 'mimes:png,bmp,gif,jpg,jpeg,pdf|max:3096'
        ]);

        $this->makeDirectory('expense_attachment');

        $voucherNo = Prefixes::generateNumber('Expense');

        $expense_head = $request->expense_head;
        $getExpenseHeadName = $this->expenseHead->getExpenseHeadName($expense_head);
        $headName = $expense_head."-".$getExpenseHeadName;
        $HeadCode = $this->accountHead->where('HeadName',$headName)->first()->HeadCode;
        $expense_amount = $request->amount;

        $this->model = $this->model::create([
            'voucher_no' => $voucherNo,
            'date' => $request->date,
            'expense_head' => $request->expense_head,
            'payment_account' => $request->payment_account,
            'amount' => $expense_amount,
            'description' => $request->description,
            'created_by' => auth()->user()->id,
            'location_id' => $this->location,
        ]);

        if ($request->file('attachment')) {
            $file = $request->file('attachment');
            if (strtolower($file->getClientOriginalExtension()) == 'pdf') {
                $name = sha1('pdf' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/expense_attachment/', $name);
            } else {
                $name = sha1('img' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->save(public_path('uploads/expense_attachment/') . $name);
            }
            $this->model->attachment = 'uploads/expense_attachment/' . $name;
            $this->model->save();
        }

        // expense type debit
        $this->model->transactions()->save(
            new Transaction([
                'Vtype' => 'Expense',
                'VDate' => $request->date,
                'COAID' => $HeadCode,
                'Narration' => 'Expense of ' . $getExpenseHeadName . ' ' . $voucherNo,
                'Debit' => $expense_amount,
                'Credit' => 0,
                'IsPosted' => 1,
                'created_by' => auth()->user()->id,
                'created_at' => Carbon::now(),
                'IsAppove' => 1,
                'location_id' => $this->location,
            ])
        );

        $payment_head = $request->payment_account;
        $getAccountHead = $this->accountHead->find($payment_head);
        $headName = $getAccountHead->HeadName;
        $HeadCode = $getAccountHead->HeadCode;

        // cash in hand or petty account credit
        $this->model->transactions()->save(
            new Transaction([
                'Vtype' => 'Expense',
                'VDate' => $request->date,
                'COAID' => $HeadCode,
                'Narration' => 'Expense From ' . $headName . ' Expense Ref# ' . $voucherNo,
                'Debit' => 0,
                'Credit' => $expense_amount,
                'IsPosted' => 1,
                'created_by' => auth()->user()->id,
                'created_at' => Carbon::now(),
                'IsAppove' => 1,
                'location_id' => $this->location
            ])
        );

        Prefixes::updateNumber('Expense');

        if ($request->doPrint == 1) {
            return redirect()->route('common.payment.receipt', ['VNo' => $this->model->voucher_no, 'type' => 'Expense']);
        } else {
            return redirect()->route('dashboard.accounts.expense.index')->with('success', trans('accounts.messages.created_expense_msg'));
        }
    }

    public function show($id)
    {
        $this->authorize('receipt', $this->model);

        $page_title = "Expense Receipt";
        $expense = $this->model->where('location_id', $this->location)->findorFail($id);

        return view('dashboard.accounts.Human-Resource.Expense.receipt', compact('expense', 'page_title'));
    }

    public function edit($id)
    {
        $this->authorize('edit', $this->model);
        abort(404);

        //$expense = Expense::where('id',$id)->first();
        //return view('dashboard.accounts.Human-Resource.Expense.edit_expense',compact('expense'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit', $this->model);
        abort(404);

        $expense = Expense::findorfail($id);
        $expense->fill([
            'date' => $request->date,
            'expense_type' => $request->expense_type,
            'payeme_type' => $request->payeme_type,
            'amount' => $request->amount,
        ])->save();

        return redirect()->route('dashboard.accounts.expense.index');
    }

    public function destroy($id)
    {
        $this->authorize('delete', $this->model);

        $expense = $this->model->where('location_id', $this->location)->findorFail($id);
        $this->transaction->where('VNo',$expense->voucher_no)->where('Vtype','Expense')
            ->where('location_id', $this->location)->delete();
        if (file_exists($expense->attachment)) {
            unlink($expense->attachment);
        }
        $expense->delete();

        return redirect()->route('dashboard.accounts.expense.index');
    }
}
