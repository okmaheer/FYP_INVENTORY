<?php

namespace App\Http\Controllers\Dashboard;

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

    function __construct(Supplier $supplier)
    {
        $this->middleware('auth');
        $this->model = $supplier;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = "Manage Suppliers";

        $supplier = $this->model;

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

        // $filter_supplier_name = $this->model::orderBy('supplier_name', 'ASC')->pluck('supplier_name', 'id');
        // $filter_supplier_cnic = $this->model::orderBy('cnic', 'ASC')->pluck('cnic', 'id');
        // $filter_supplier_mobile = $this->model::orderBy('supplier_mobile', 'ASC')->pluck('supplier_mobile', 'id');

        return view('dashboard.supplier.supplier_table',compact('supplier', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $page_title = "Create New Supplier";
        return view('dashboard.supplier.add_supplier', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        ]);
        return redirect()->route('dashboard.accounts.supplier.index')->with('success', trans('accounts.messages.created_supplier_msg'));
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
        $page_title = "Modify Supplier";

        $supplier = Supplier::findorFail($id);
        return view('dashboard.supplier.edit_supplier',compact('supplier', 'page_title'));
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
        $supplier = Supplier::findorfail($id);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findorFail($id);
        $supplier->delete();

        return redirect()->route('dashboard.accounts.supplier.index')->with('success', trans('accounts.messages.deleted_supplier_msg'));
    }
}
