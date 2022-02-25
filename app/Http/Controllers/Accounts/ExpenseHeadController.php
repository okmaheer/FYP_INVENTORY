<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use Illuminate\Http\Request;
use App\Models\ExpenseHead;
use Illuminate\Support\Facades\DB;

class ExpenseHeadController extends Controller
{
    public $model;
    public $account_head;
    private $location;

    function __construct(ExpenseHead $expense_head, AccountHead $account_head)
    {
        $this->middleware('auth');
        $this->model = $expense_head;
        $this->account_head = $account_head;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function index()
    {
        $this->authorize('view', $this->model);

        $expense_heads = $this->model->where('location_id', $this->location)->get();
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Expense Head' => '',
        ]);

        $page_title = "Manage Expense Head";
        return view('dashboard.accounts.Human-Resource.Expense.ExpenseHead.index',compact('page_title', 'breadcrumbs','expense_heads','page_title'));
    }

    public function create()
    {
        $this->authorize('create', $this->model);

        $parentHeads = $this->model->where('location_id', $this->location)->whereParentId('0')
            ->orderBy('expense_head_name', 'ASC')->pluck('expense_head_name', 'id');
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Expense Head' => route('dashboard.accounts.expensehead.index'),
            'Create New Expense Head' => ''
        ]);

        $page_title = "Create New Expense Head";
        return view('dashboard.accounts.Human-Resource.Expense.ExpenseHead.add',compact('page_title', 'breadcrumbs','page_title', 'parentHeads'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', $this->model);

        $this->model = $this->model::create([
            'expense_head_name' => $request->expense_head_name,
            'parent_id' => is_null($request->parent_id) ? '0' : $request->parent_id,
            'created_by' => auth()->user()->id,
            'location_id' => $this->location,
        ]);

        if ($this->model) {
            if (is_null($request->parent_id)) {
                $headCode = $this->headCode(1);
                if($headCode!=NULL) {
                    $headCode=$headCode+1;
                } else {
                    $headCode="4000001";
                }
                $headName = $this->model->headName();
                $this->account_head::create([
                    'HeadCode'         => $headCode,
                    'HeadName'         => $headName,
                    'PHeadName'        => 'Expense',
                    'HeadLevel'        => '1',
                    'IsActive'         => '1',
                    'IsTransaction'    => '1',
                    'IsGL'             => '0',
                    'HeadType'         => 'E',
                    'IsBudget'         => '1',
                    'IsDepreciation'   => '1',
                    'DepreciationRate'=> '1',
                    'location_id'      => $this->location,
                    'created_by' => auth()->user()->id,
                    'UpdatedBy' => auth()->user()->id,
                ]);

            } else {
                $headCode = $this->headCode(2);
                if($headCode!=NULL) {
                    $headCode=$headCode+1;
                } else {
                    $headCode="6000001";
                }
                $headName = $this->model->headName();
                $parentHeadName = $request->parent_id.'-'.$this->model->getExpenseHeadName($request->parent_id);

                $this->account_head::create([
                    'HeadCode'         => $headCode,
                    'HeadName'         => $headName,
                    'PHeadName'        => $parentHeadName,
                    'HeadLevel'        => '2',
                    'IsActive'         => '1',
                    'IsTransaction'    => '1',
                    'IsGL'             => '0',
                    'HeadType'         => 'E',
                    'IsBudget'         => '1',
                    'IsDepreciation'   => '1',
                    'DepreciationRate' => '1',
                    'location_id'      => $this->location,
                    'created_by' => auth()->user()->id,
                    'UpdatedBy' => auth()->user()->id,
                ]);
            }
        }

        if ($request->saveNew) {
            return redirect()->route('dashboard.accounts.expensehead.create')->with('success', trans('accounts.messages.created_expense_head_msg'));
        } else {
            return redirect()->route('dashboard.accounts.expensehead.index')->with('success', trans('accounts.messages.created_expense_head_msg'));
        }
    }

    public function show($id)
    {
        //

    }

    public function edit($id)
    {
        abort(404);
        $this->authorize('edit', $this->model);

        $page_title = "Edit Expense Head";
        $model = $this->model->where('location_id', $this->location)->findorFail($id);
        $parentHeads = $this->model->where('location_id', $this->location)->whereParentId('0')
            ->orderBy('expense_head_name', 'ASC')->pluck('expense_head_name', 'id');
        return view('dashboard.accounts.Human-Resource.Expense.ExpenseHead.edit',compact('model','page_title','parentHeads'));
    }

    public function update(Request $request, $id)
    {
        abort(404);
        $this->authorize('edit', $this->model);

        $this->model = $this->model->where('location_id', $this->location)->findorFail($id);
        $this->model->fill([
            'expense_head_name' => $request->expense_head_name,
            'updated_by' => auth()->user()->id,
        ])->save();

        return redirect()->route('dashboard.accounts.expensehead.index')->with('success', trans('accounts.messages.updated_expense_head_msg'));
    }

    public function destroy($id)
    {
        $this->authorize('delete', $this->model);

        $expense_item = $this->model->where('location_id', $this->location)->findorFail($id);
        $expense_item->delete();

        return redirect()->route('dashboard.accounts.expensehead.index')->with('success', trans('accounts.messages.deleted_expense_head_msg'));
    }

    private function headCode($level){
        if ($level == 1) {
            $headCode =
            AccountHead::where('HeadLevel',1)
                ->where('HeadCode', 'like',  '4000' . '%')
                ->max('HeadCode');
        } else {
            $headCode =
            AccountHead::where('HeadLevel',2)
                ->where('HeadCode', 'like',  '6000' . '%')
                ->max('HeadCode');
        }
        return $headCode;
    }
    public function FindSubExpenseHead(Request $request) {
        if ($request->ajax()) {
            $parent_head = $request->d;
            $sub_heads = $this->model->where('location_id', $this->location)->whereParentId($parent_head)
                ->orderBy('expense_head_name', 'ASC')->pluck('expense_head_name', 'id');
            return $sub_heads;
        }
    }
}
