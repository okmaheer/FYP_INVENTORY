<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductService;

class ServiceController extends Controller
{
    public $model;

    function __construct(ProductService $service)
    {
        $this->middleware('auth');
        $this->model = $service;
    }

    public function invoice()
    {
        //
        return view('dashboard.accounts.Service.service_invoice');
    }
    public function manage()
    {
        //
        return view('dashboard.accounts.Service.manage_service_invoice');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $this->authorize('view', ProductService::class);
        $service = ProductService::all();
        return view('dashboard.accounts.Service.manage_service',compact('service'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $this->authorize('create', ProductService::class);
        return view('dashboard.accounts.Service.add_service');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $this->authorize('create', ProductService::class);
        $service = ProductService::create([
            'service_name' => $request->service_name,
            'charge' => $request->charge,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard.accounts.service.index')->with('success', trans('accounts.messages.created_service_msg'));
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
        $service = ProductService::where('id',$id)->first();
        return view('dashboard.accounts.Service.edit_service',compact('service'));
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
        $service = ProductService::findorfail($id);
        $service->fill([
            'service_name' => $request->service_name,
            'charge' => $request->charge,
            'description' => $request->description,
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
        $service = ProductService::findorfail($id);
        $service->delete();

        return redirect()->route('dashboard.accounts.service.index');
    }
}
