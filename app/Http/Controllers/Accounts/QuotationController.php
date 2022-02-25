<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotation;
use Carbon\Carbon;
use App\Models\Customer;

class QuotationController extends Controller
{
    public $model;

    function __construct(Quotation $quotation)
    {
        $this->middleware('auth');
        $this->model = $quotation;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('view', Quotation::class);
        $quotation = Quotation::all();
        return view('dashboard.accounts.Quotation.manage_quotation',compact('quotation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $this->authorize('create', Quotation::class);
        $todayDate = Carbon::today()->toDateString();
        $customer = Customer::pluck('customer_name', 'id');
        return view('dashboard.accounts.Quotation.add_quotation',compact('customer','todayDate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $this->authorize('create', Quotation::class);
        Quotation::create([
            'customer_id' => $request->customer_id ?? "",
            'quotation_no' => $request->quotation_no ?? "",
            'address' => $request->address ?? "",
            'qdate' => $request->qdate ?? "",
            'mobile' => $request->mobile ?? "",
            'expiry_date' => $request->expiry_date ?? "",
            'details' => $request->details ?? "",
            'product_name' => $request->product_name ?? "",
            'desc' => $request->desc ?? "",
            'available_quantity' => $request->available_quantity ?? "",
            'product_quantity' => $request->product_quantity ?? "",
            'product_rate' => $request->product_rate ?? "",
            'discount' => $request->discount ?? "",
            'total_price' => $request->total_price ?? "",

        ]);

        return redirect()->route('dashboard.accounts.quotation.index')->with('success', trans('accounts.messages.created_quotation_msg'));
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
        //
        $customer = Customer::pluck('customer_name', 'id');
        $quotation = Quotation::where('id',$id)->first();
        return view('dashboard.accounts.Quotation.Edit_quotation',compact('service'.'customer'));
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
        //
        $quotation = Quotation::findorfail($id);
        $quotation->fill([
            'customer_id' => $request->customer_id ?? "",
            'quotation_no' => $request->quotation_no ?? "",
            'address' => $request->address ?? "",
            'qdate' => $request->qdate ?? "",
            'mobile' => $request->mobile ?? "",
            'expiry_date' => $request->expiry_date ?? "",
            'details' => $request->details ?? "",
            'product_name' => $request->product_name ?? "",
            'desc' => $request->desc ?? "",
            'available_quantity' => $request->available_quantity ?? "",
            'product_quantity' => $request->product_quantity ?? "",
            'product_rate' => $request->product_rate ?? "",
            'discount' => $request->discount ?? "",
            'total_price' => $request->total_price ?? "",

        ])->save();

        return redirect()->route('dashboard.accounts.service.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $quotation = Quotation::findorfail($id);
        $quotation->delete();

        return redirect()->route('dashboard.accounts.service.index');
    }
}
