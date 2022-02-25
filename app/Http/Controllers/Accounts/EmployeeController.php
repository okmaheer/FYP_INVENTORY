<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Designation;
use App\Traits\General;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Rats\Zkteco\Lib\Helper\Util;
use Rats\Zkteco\Lib\ZKTeco;

class EmployeeController extends Controller
{
    use General;
    private $location;
    public $model;

    function __construct(Employee $employee)
    {
        $this->middleware('auth');
        $this->model = $employee;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function index()
    {
        $this->authorize('view', $this->model);

        $breadcrumbs = collect([
            __('accounts.general.dashboard') => route('dashboard'),
            __('accounts.hrm.manage_employees') => '',
        ]);
        $page_title =  __('accounts.hrm.manage_employees');

        $employee = $this->model->where('location_id', $this->location)->with('designation')->get();
        return view('dashboard.accounts.Human-Resource.HRM.manage_employee',compact('page_title', 'breadcrumbs','employee'));
    }

    public function create()
    {
        $this->authorize('create', $this->model);

        $breadcrumbs = collect([
            __('accounts.general.dashboard') => route('dashboard'),
            __('accounts.hrm.manage_employees') => route('dashboard.accounts.employee.index'),
            __('accounts.hrm.employee_add') => ''
        ]);
        $page_title =  __('accounts.hrm.employee_add');

        $designation = Designation::where('location_id', $this->location)
            ->orderBy('name', 'ASC')->pluck('name', 'id');
        return view('dashboard.accounts.Human-Resource.HRM.add_employee',compact('page_title', 'breadcrumbs','designation'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', $this->model);

        $this->makeDirectory('employee_image');
        $this->makeDirectory('employee_document');

        $this->model = $this->model::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'designation_id' => $request->designation_id,
            'phone' => $request->phone,
            'rate_type' => $request->rate_type,
            'hrate' => $request->hrate,
            'email' => $request->email,
            'blood_group' => $request->blood_group,
            'address_line_1' => $request->address_line_1,
            'loan_percentage' => $request->loan_percentage,
            'country' => $request->country,
            'city' => $request->city,
            'zip' => $request->zip,
            'working_hour' => $request->working_hour,
            'location_id' => $this->location,
        ]);

        if ($request->file('image')) {
            $file = $request->file('image');
            $name = sha1('img' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $image->save(public_path('uploads/employee_image/') . $name);
            $this->model->image = 'uploads/employee_image/' . $name;
            $this->model->save();
        }

        if(isset($request->document) && $request->has('document') ){
            $file = $request->file('document');
            $uniqueFileName = sha1('doc' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();

            $path = public_path() . '/uploads/employee_document/' . $uniqueFileName;
            $request->document->move(public_path('/uploads/employee_document/'), $uniqueFileName);
            $this->model->document = 'uploads/employee_document/' . $uniqueFileName;
            $this->model->save();
        }

        $headCode = $this->headCode();
        $headName = $this->model->headName();

        if($headCode!=NULL){
            $headCode=$headCode+1;
        }else{
            $headCode="502040001";
        }

        $this->model->accountHead()->save(
            new AccountHead([
                'HeadCode'         => $headCode,
                'HeadName'         => $headName,
                'PHeadName'        => 'Employee Ledger',
                'HeadLevel'        => '3',
                'IsActive'         => '1',
                'IsTransaction'    => '1',
                'IsGL'             => '0',
                'HeadType'         => 'L',
                'IsBudget'         => '0',
                'IsDepreciation'   => '0',
                'DepreciationRate' => '0',
                'location_id'      => $this->location,
            ])
        );

        if ($request->saveNew) {
            return redirect()->route('dashboard.accounts.employee.create')->with('success', trans('accounts.messages.created_employee_msg'));
        } else {
            return redirect()->route('dashboard.accounts.employee.index')->with('success', trans('accounts.messages.created_employee_msg'));
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->authorize('edit', $this->model);

        $breadcrumbs = collect([
            __('accounts.general.dashboard') => route('dashboard'),
            __('accounts.hrm.manage_employees') => route('dashboard.accounts.employee.index'),
            __('accounts.hrm.employee_modify') => ''
        ]);
        $page_title =  __('accounts.hrm.employee_modify');

        $designation = Designation::where('location_id', $this->location)
            ->orderBy('name', 'ASC')->pluck('name', 'id');
        $model = $this->model->where('location_id', $this->location)->findorFail($id);
        return view('dashboard.accounts.Human-Resource.HRM.edit_employee',compact('page_title', 'breadcrumbs','model','designation'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit', $this->model);

        $this->makeDirectory('employee_image');
        $this->makeDirectory('employee_document');

        $this->model = $this->model->where('location_id', $this->location)->findorFail($id);
        $old_image = $this->model->image;
        $old_doc = $this->model->document;

        $this->model = $this->model->fill([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'designation_id' => $request->designation_id,
            'phone' => $request->phone,
            'rate_type' => $request->rate_type,
            'hrate' => $request->hrate,
            'email' => $request->email,
            'blood_group' => $request->blood_group,
            'address_line_1' => $request->address_line_1,
            'loan_percentage' => $request->loan_percentage,
            'country' => $request->country,
            'city' => $request->city,
            'zip' => $request->zip,
            'working_hour' => $request->working_hour,
        ])->save();

        if ($request->file('image')) {
            if (file_exists($old_image)) {
                unlink ($old_image);
            }

            $file = $request->file('image');
            $name = sha1('img' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $image->save(public_path('uploads/employee_image/') . $name);
            $this->model->image = 'uploads/employee_image/' . $name;
            $this->model->save();
        }

        if(isset($request->document) && $request->has('document') ){
            if (file_exists($old_doc)) {
                unlink ($old_doc);
            }

            $file = $request->file('document');
            $uniqueFileName = sha1('doc' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();

            $path = public_path() . '/uploads/employee_document/' . $uniqueFileName;
            $request->document->move(public_path('/uploads/employee_document/'), $uniqueFileName);
            $this->model->document = 'uploads/employee_document/' . $uniqueFileName;
            $this->model->save();
        }

        return redirect()->route('dashboard.accounts.employee.index')->with('success', trans('accounts.messages.updated_employee_msg'));
    }

    public function destroy($id)
    {
        $this->authorize('delete', $this->model);

        $employee = $this->model->where('location_id', $this->location)->findorFail($id);
        $employee->delete();

        return redirect()->route('dashboard.accounts.employee.index')->with('success', trans('accounts.messages.deleted_employee_msg'));
    }

    private function headCode(){
        $headCode =
            AccountHead::where('HeadLevel',3)
                ->where('HeadCode', 'like',  '50204' . '%')
                ->max('HeadCode');
        return $headCode;
    }

    public function syncEmployeeWithMachine(Request $request) {
        $employeeAlreadyAdded = [];
        $output = ['success' => false, 'msg' => ''];
        if (Auth::user()->can('sync', $this->model)) {
            if ($request->ajax()) {
                $hardwareSetting = \AccountHelper::hardwareSettings();
                $zk = new ZKTeco($hardwareSetting->attendance_ip, $hardwareSetting->attendance_port);
                if ($zk->connect()) {
                    $users = $zk->getUser();

                    if (count($users) > 0) {
                        foreach ($users as $key => $user) {
                            $employeeAlreadyAdded[] = $user['userid'];
                        }
                    }

                    if (count($employeeAlreadyAdded) > 0) {
                        $employees = $this->model->where('location_id', $this->location)->whereNotIn('id', $employeeAlreadyAdded)->orderBy('id')->get();
                    } else {
                        $employees = $this->model->where('location_id', $this->location)->orderBy('id')->get();
                    }
                    if ($employees->count() > 0) {
                        foreach ($employees as $employee) {
                            $name = Str::limit($employee->full_name, 24, '');
                            $zk->setUser($employee->id, $employee->id, $name, '1234', Util::LEVEL_USER, 0);
                        }
                        $output = ['success' => true, 'msg' => $employees->count() . ' employees synchronized successfully!'];
                    } else {
                        $output = ['success' => true, 'msg' => 'All employees already synchronized!'];
                    }

                    $zk->disconnect();
                } else {
                    $output['msg'] = 'It seems attendance machine is offline. Please try again later!';
                }
            } else {
                $output['msg'] = __('accounts.messages.invalid_request');
            }
        } else {
            $output['msg'] = 'You are not allowed to perform this action.';
        }
        return $output;
    }
}
