<?php

namespace App\Http\Controllers\Accounts;


use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use Illuminate\Http\Request;
use App\Models\IncomeHead;
use Illuminate\Support\Facades\DB;

class IncomeHeadController extends Controller
{
    public $model;
    public $account_head;
    private $location;

    function __construct(IncomeHead $income_head, AccountHead $account_head)
    {
        $this->middleware('auth');
        $this->model = $income_head;
        $this->account_head = $account_head;
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
        $this->authorize('view', $this->model);

        $page_title = "List of Income Heads";
        $income_heads = $this->model->where('location_id', $this->location)->get();
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Income Head' => '',

        ]);

        $page_title = "Manage Income Head";
        return view('dashboard.accounts.Human-Resource.Income.IncomeHead.index',compact('page_title', 'breadcrumbs','income_heads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', $this->model);

        $parentHeads = $this->model->where('location_id', $this->location)->whereParentId('0')
            ->orderBy('income_head_name', 'ASC')->pluck('income_head_name', 'id');
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Income Head' => route('dashboard.accounts.incomehead.index'),
            'Create New Income Head' => ''
        ]);

        $page_title = "Create New Income Head";
        return view('dashboard.accounts.Human-Resource.Income.IncomeHead.add',compact('page_title', 'breadcrumbs', 'parentHeads'));
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

        $this->model = $this->model::create([
            'income_head_name' => $request->income_head_name,
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
                    $headCode="305";
                }
                $headName = $this->model->headName();
                $this->account_head::create([
                    'HeadCode'         => $headCode,
                    'HeadName'         => $headName,
                    'PHeadName'        => 'Income',
                    'HeadLevel'        => '1',
                    'IsActive'         => '1',
                    'IsTransaction'    => '1',
                    'IsGL'             => '0',
                    'HeadType'         => 'I',
                    'IsBudget'         => '1',
                    'IsDepreciation'   => '1',
                    'depreciation_rate' => '1',
                    'location_id'      => $this->location,
                    'created_by' => auth()->user()->id,
                ]);

            } else {
                $headCode = $this->headCode(2);
                if($headCode!=NULL) {
                    $headCode=$headCode+1;
                } else {
                    $headCode="3070001";
                }
                $headName = $this->model->headName();
                $parentHeadName = $request->parent_id.'-'.$this->model->getIncomeHeadName($request->parent_id);

                $this->account_head::create([
                    'HeadCode'         => $headCode,
                    'HeadName'         => $headName,
                    'PHeadName'        => $parentHeadName,
                    'HeadLevel'        => '2',
                    'IsActive'         => '1',
                    'IsTransaction'    => '1',
                    'IsGL'             => '0',
                    'HeadType'         => 'I',
                    'IsBudget'         => '1',
                    'IsDepreciation'   => '1',
                    'depreciation_rate' => '1',
                    'location_id'      => $this->location,
                    'created_by' => auth()->user()->id,
                ]);
            }
        }

        if ($request->saveNew) {
            return redirect()->route('dashboard.accounts.incomehead.create')->with('success', trans('accounts.messages.created_income_head_msg'));
        } else {
            return redirect()->route('dashboard.accounts.incomehead.index')->with('success', trans('accounts.messages.created_income_head_msg'));
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
        $this->authorize('edit', $this->model);

        $page_title = "Edit Income Head";
        $model = $this->model->where('location_id', $this->location)->findorFail($id);
        $parentHeads = $this->model->where('location_id', $this->location)->whereParentId('0')
            ->orderBy('income_head_name', 'ASC')->pluck('income_head_name', 'id');
        return view('dashboard.accounts.Human-Resource.Income.IncomeHead.edit',compact('model','page_title','parentHeads'));
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

        $this->model = $this->model->where('location_id', $this->location)->findorFail($id);
        $this->model->fill([
            'income_head_name' => $request->income_head_name,
            'updated_by' => auth()->user()->id,
        ])->save();

        return redirect()->route('dashboard.accounts.incomehead.index')->with('success', trans('accounts.messages.updated_income_head_msg'));
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

        $income_item = $this->model->where('location_id', $this->location)->findorFail($id);
        $income_item->delete();

        return redirect()->route('dashboard.accounts.incomehead.index')->with('success', trans('accounts.messages.deleted_income_head_msg'));
    }


    private function headCode($level){
        if ($level == 1) {
            $headCode =
            AccountHead::where('HeadLevel',1)
                ->where('HeadCode', 'like',  '30' . '%')
                ->max('HeadCode');
        } else {
            $headCode =
            AccountHead::where('HeadLevel',2)
                ->where('HeadCode', 'like',  '307000' . '%')
                ->max('HeadCode');
        }
        return $headCode;
    }
    public function FindSubIncomeHead(Request $request) {
        if ($request->ajax()) {
            $parent_head = $request->d;
            $sub_heads = $this->model->where('location_id', $this->location)->whereParentId($parent_head)
                ->orderBy('income_head_name', 'ASC')->pluck('income_head_name', 'id');
            return $sub_heads;
        }
    }
}
