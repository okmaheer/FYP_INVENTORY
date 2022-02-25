<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public $model;
    private $location;

    function __construct(Unit $unit)
    {
        $this->middleware('auth');
        $this->model = $unit;
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

        $pageTittle = "Manage unit";
        $data = Unit::where('location_id', $this->location)
            ->orderBy('unit_name', 'ASC')->paginate(12);
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Unit List' => '',
        ]);

        $page_title = "Unit List";
        return view('dashboard.accounts.products.unit_list',compact('page_title', 'breadcrumbs','pageTittle','data'));
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
            'Unit List' => route('dashboard.accounts.unit.index'),
            'Create New Unit' => ''
        ]);

        $page_title = "Create New Unit";
        return view('dashboard.accounts.products.add_unit',compact('page_title', 'breadcrumbs',));
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

        Unit::create([
            'unit_name' => $request->unit_name,
            'status' => $request->status,
            'location_id' => $this->location,
        ]);

        if ($request->saveNew == 1) {
            return redirect()->route('dashboard.accounts.unit.create')->with('success', trans('accounts.messages.created_unit_msg'));
        } else {
            return redirect()->route('dashboard.accounts.unit.index')->with('success', trans('accounts.messages.created_unit_msg'));
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

        $pageTittle = "Edit Unit";
        $unit = Unit::where('location_id', $this->location)->findorFail($id);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Unit List' => route('dashboard.accounts.unit.index'),
            'Modify Unit' => ''
        ]);

        $page_title = "Modify Unit";
        return view('dashboard.accounts.products.edit_unit',compact('page_title', 'breadcrumbs',
        'pageTittle','unit'));
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

        $unit = Unit::where('location_id', $this->location)->findorFail($id);
        $unit->fill([
            'unit_name' => $request->unit_name,
            'status' => $request->status,
        ])->save();
        return redirect()->route('dashboard.accounts.unit.index')->with('success', trans('accounts.messages.updated_unit_msg'));
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

        $category = Unit::where('location_id', $this->location)->findorFail($id);
        $category->delete();
        return redirect()->route('dashboard.accounts.unit.index')->with('success', trans('accounts.messages.deleted_unit_msg'));

    }
}
