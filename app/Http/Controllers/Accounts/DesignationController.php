<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public $model;
    private $location;

    function __construct(Designation $designation)
    {
        $this->middleware('auth');
        $this->model = $designation;
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

        $designation = Designation::where('location_id', $this->location)->get();
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Designation' => '',
        ]);

        $page_title = "Manage Designation";
        return view('dashboard.accounts.Human-Resource.HRM.manage_designation',compact('page_title', 'breadcrumbs','designation'));
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
            'Manage Designation' => route('dashboard.accounts.designation.index'),
            'Create New Designation' => ''
        ]);

        $page_title = "Create New Designation";

        return view('dashboard.accounts.Human-Resource.HRM.add_designation',compact('page_title', 'breadcrumbs'));
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

        $designation = Designation::create([
            'name' => $request->name,
            'detail' => $request->detail,
            'location_id' => $this->location,
        ]);

        if ($request->saveNew) {
            return redirect()->route('dashboard.accounts.designation.create')->with('success', trans('accounts.messages.created_designation_msg'));
        } else {
            return redirect()->route('dashboard.accounts.designation.index')->with('success', trans('accounts.messages.created_designation_msg'));
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

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Designation' => route('dashboard.accounts.designation.index'),
            'Modify Designation' => ''
        ]);

        $page_title = "Modify Designation";

        $designation = Designation::where('location_id', $this->location)->findorFail($id);
        return view('dashboard.accounts.Human-Resource.HRM.edit_designation',compact('page_title', 'breadcrumbs', 'designation'));
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

        $designation = Designation::where('location_id', $this->location)->findorFail($id);
        $designation->fill([
            'designation' => $request->designation,
            'detail' => $request->detail
        ])->save();

        return redirect()->route('dashboard.accounts.designation.index')->with('success', trans('accounts.messages.updated_designation_msg'));
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

        $designation = Designation::where('location_id', $this->location)->findorFail($id);
        $designation->delete();

        return redirect()->route('dashboard.accounts.designation.index')->with('success', trans('accounts.messages.deleted_designation_msg'));
    }
}
