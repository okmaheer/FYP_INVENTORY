<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Rats\Zkteco\Lib\ZKTeco;

class AttendanceController extends Controller
{
    public $model;
    protected $employees;
    private $location;

    function __construct(Attendance $attendance, Employee $employees)
    {
        $this->middleware('auth');
        $this->model = $attendance;
        $this->employees = $employees;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function index()
    {
        $this->authorize('view', $this->model);

        $attendance = $this->model->where('location_id', $this->location)->get();
        $employees = $this->employees->where('location_id', $this->location)->with('attendance')->get()->sortBy('full_name');
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Attendance' => '',
        ]);

        $page_title = "Manage Attendance";
        return view('dashboard.accounts.Human-Resource.Attendance.manage_attendance',compact('page_title', 'breadcrumbs','attendance', 'employees'));
    }

    public function create()
    {
        $this->authorize('create', $this->model);

        $employees = $this->employees->where('location_id', $this->location)->get()->sortBy('full_name')->pluck('full_name','id');
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Attendance' => route('dashboard.accounts.attendance.index'),
            'Manual Attendance' => ''
        ]);

        $page_title = "Manual Attendance";

        $attendance = $this->model->where('location_id', $this->location)->whereDate('clock_out', Carbon::today())->get();

        return view('dashboard.accounts.Human-Resource.Attendance.attendance',compact('page_title', 'breadcrumbs','employees', 'attendance'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', $this->model);

        $employee_id = $request->input('employee_id', array());
        foreach ($employee_id as $key => $value){
            $attendanceKey = "attendance_" . ($key+1);
            $attendance = $request->$attendanceKey;

            switch ($attendance) {
                case 'present':
                    $employee = $this->employees->findorFail($value);
                    $clockIn = Carbon::now();
                    $clockOut = Carbon::now()->addHours($employee->working_hour);
                    break;
                case 'half':
                    $employee = $this->employees->findorFail($value);
                    $clockIn = Carbon::now();
                    $clockOut = Carbon::now()->addHours(($employee->working_hour / 2));
                    break;
                case 'absent':
                    $clockIn = Carbon::now();
                    $clockOut = Carbon::now();
                    break;
            }
            $this->model->create([
                'employee_id' => $value,
                'clock_in' => $clockIn,
                'clock_out' => $clockOut,
                'created_by' => auth()->user()->id,
                'created_at' => Carbon::now(),
                'location_id' => $this->location,
            ]);
        }

        return redirect()->route('dashboard.accounts.attendance.index')->with('success', trans('accounts.messages.created_attendance_msg'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->authorize('edit', $this->model);

        $employees = $this->employees->where('location_id', $this->location)->get()->sortBy('full_name')->pluck('full_name','id');
        $attendance = $this->model->where('location_id', $this->location)->findorFail($id);
        return view('dashboard.accounts.Human-Resource.Attendance.edit_attendance',compact('attendance','employee'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit', $this->model);

        $attendance = $this->model->where('location_id', $this->location)->findorFail($id);
        $attendance->fill([
            'employee_id' => $request->employee_id,
            'date' => $request->date,
            'attendance' => $request->attendance,
        ])->save();

        return redirect()->route('dashboard.accounts.attendance.index')->with('success', trans('accounts.messages.created_attendance_msg'));
    }

    public function destroy($id)
    {
        $this->authorize('delete', $this->model);

        $attendance = $this->model->where('location_id', $this->location)->findorFail($id);
        $attendance->delete();

        return redirect()->route('dashboard.accounts.attendance.index');
    }

    public function attendanceReport(Request $request) {

        $this->authorize('report', $this->model);

        $employees = $this->employees->where('location_id', $this->location)->whereHas('attendance', function ($query) use ($request) {
            if ($request->filled('attendance_month')) {
                $tempYear = Carbon::parse($request->attendance_month)->year;
                $tempMonth = Carbon::parse($request->attendance_month)->month;
                $query->whereYear('clock_in', $tempYear)->whereMonth('clock_in', $tempMonth);

                if ($request->filled('employee_id')) {
                    $query->where('employee_id', $request->employee_id);
                }
            }
        })->get();
//        $employees = $this->employees->get()->sortBy('full_name');

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Attendance' => route('dashboard.accounts.attendance.index'),
            'Attendance Report' => '',
        ]);

        $page_title = "Attendance Report";

        $employeesFilter = $this->employees->where('location_id', $this->location)->get()
            ->sortBy('full_name')->pluck('full_name', 'id');

        return view('dashboard.accounts.Human-Resource.Attendance.attendance_report',compact('page_title', 'breadcrumbs','employeesFilter','employees'));
    }

    public function syncAttendanceFromMachine(Request $request) {
        $output = ['success' => false, 'msg' => ''];

        if (Auth::user()->can('syncAttendance', $this->model)) {
            $hardwareSetting = \AccountHelper::hardwareSettings();
            $zk = new ZKTeco($hardwareSetting->attendance_ip, $hardwareSetting->attendance_port);
            if ($zk->connect()) {
                $attendanceRecords = $zk->getAttendance();

                if (count($attendanceRecords) > 0) {
                    foreach ($attendanceRecords as $key => $attendance) {
                        $findExistingEntry = $this->model->where('location_id', $this->location)->where('employee_id', $attendance['id'])
                            ->whereNull('clock_out')->first();
                        if ($findExistingEntry) {
                            $clockIn = Carbon::parse($findExistingEntry->clockIn);
                            $clockOut = Carbon::parse($attendance['timestamp']);

                            if ($clockIn->diffInMinutes($clockOut) > 1) {
                                $findExistingEntry->clock_out = $clockOut;
                                $findExistingEntry->updated_by = auth()->user()->id;
                                $findExistingEntry->save();
                            }
                        } else {
                            $this->model->create([
                                'employee_id' => $attendance['id'],
                                'clock_in' => $attendance['timestamp'],
                                'created_by' => auth()->user()->id,
                                'location_id' => $this->location,
                            ]);
                        }
                    }
                    $output = ['success' => true, 'msg' => 'Attendance records synced successfully.'];
                } else {
                    $output = ['success' => true, 'msg' => 'No attendance record found in machine.'];
                }
                $zk->clearAttendance();
                $zk->disconnect();
            } else {
                $output['msg'] = 'It seems attendance machine is offline. Please try again later!';
            }
        } else {
            $output['msg'] = 'You are not allowed to perform this action.';
        }
        return $output;
    }
}
