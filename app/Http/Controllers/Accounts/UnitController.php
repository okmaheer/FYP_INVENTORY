<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public $model;

    function __construct(Unit $data)
    {
        $this->middleware('auth');
        $this->model = $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('view', Unit::class);
        $pageTittle = "Manage unit";
        $data       = Unit::orderBy('unit_name')->paginate(12);
        return view('dashboard.accounts.products.unit_list',compact('pageTittle','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $this->authorize('create', Unit::class);
        return view('dashboard.accounts.products.add_unit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->authorize('create', Unit::class);
        Unit::create([
            'unit_name' => $request->unit_name,
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard.accounts.unit.index')->with('success', trans('accounts.messages.created_unit_msg'));

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
        $pageTittle = "Edit Unit";
        $unit = Unit::findorfail($id);
        return view('dashboard.accounts.products.edit_unit',compact('pageTittle','unit'));
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
        $unit = Unit::findorfail($id);
        $unit->fill([
            'unit_name' => $request->unit_name,
            'status' => $request->status,
        ])->save();
        return redirect()->route('dashboard.accounts.unit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Unit::findorfail($id);
        $category->delete();
        return redirect()->route('dashboard.accounts.unit.index');

    }
}
