<?php

namespace App\Http\Controllers\Dashboard;
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

        $pageTittle = "Manage unit";
        $data = Unit::orderBy('unit_name', 'ASC')->paginate(12);
    

        $page_title = "Unit List";
        return view('dashboard.products.unit_list',compact('page_title','pageTittle','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Unit List' => route('dashboard.accounts.unit.index'),
            'Create New Unit' => ''
        ]);

        $page_title = "Create New Unit";
        return view('dashboard.products.add_unit',compact('page_title',));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        Unit::create([
            'unit_name' => $request->unit_name,
            'status' => $request->status,
           
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

        $pageTittle = "Edit Unit";
        $unit = Unit::findorFail($id);

       

        $page_title = "Modify Unit";
        return view('dashboard.products.edit_unit',compact('page_title','pageTittle','unit'));
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
        

        $unit = Unit::findorFail($id);
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
        $unit = Unit::findorFail($id);
        $unit->delete();
        return redirect()->route('dashboard.accounts.unit.index')->with('success', trans('accounts.messages.deleted_unit_msg'));

    }
}
