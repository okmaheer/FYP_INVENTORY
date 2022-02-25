<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceInvoice;

class ServiceInvoiceController extends Controller
{
    public $model;

    function __construct(ServiceInvoice $service_invoice)
    {
        $this->middleware('auth');
        $this->model = $service_invoice;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $this->authorize('view', ServiceInvoice::class);
        return view('dashboard.accounts.Service.manage_service_invoice');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $this->authorize('create', ServiceInvoice::class);
        return view('dashboard.accounts.Service.service_invoice');
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
        // $this->authorize('create', ServiceInvoice::class);
        $service_invoice = ServiceInvoice::create([
            'name' => $request->name ?? "",
            'status' => $request->status ?? ""
        ]);

        return redirect()->route('dashboard.accounts.service_invoice.index')->with('success', trans('accounts.messages.created_service_invoice_msg'));
        // Invoice0::create([
        //     'name' => $request->name ?? "",
        //     'status' => $request->status ?? ""
        // ]);

        // return redirect()->route('category.create');
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
        $service_invoice = ServiceInvoice::where('id',$id)->first();
        return view('dashboard.accounts.Service.Edit_service_invoice',compact('service_invoice'));
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
        $service_invoice = ServiceInvoice::findorfail($id);
        $service_invoice->fill([
            'name' => $request->name ?? "",
            'status' => $request->status ?? ""
        ])->save();

        return redirect()->route('dashboard.accounts.service_invoice.index');
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
        $service_invoice = ServiceInvoice::findorfail($id);
        $service_invoice->delete();

        return redirect()->route('dashboard.accounts.service_invoice.index');
    }
}
