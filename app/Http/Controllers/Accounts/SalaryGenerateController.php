<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\Employee;
use App\Models\EmployeeLoan;
use App\Models\Prefixes;
use App\Models\Salary;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalaryGenerateController extends Controller
{
    public $model;
    public $employee;
    private $location;

    function __construct(Salary $salary,Employee $employee)
    {
        $this->middleware('auth');
        $this->model = $salary;
        $this->employee = $employee;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function SalaryPayment()
    {

//        return view('dashboard.accounts.Human-Resource.Payroll.salary_payment');
    }

    public function salary_employee()
    {
        $this->authorize('create', $this->model);

        $employee_id = $this->employee->where('location_id', $this->location)->where('rate_type', 1)->get()
            ->sortBy('full_name')->pluck('full_name','id');

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Salary' => route('dashboard.accounts.salary_generate.index'),
            'Employee Salary' => ''
        ]);

        $page_title = "Employee Salary";
        return view('dashboard.accounts.Human-Resource.Payroll.salary_employee',compact('page_title', 'breadcrumbs','employee_id'));
    }
    public function addEmployeeSalary(Request $request){
        $this->authorize('create', $this->model);

        if ($request->filled('autoSalary')) {
            $finalOutput = ['success' => true, 'month' => $request->salary_month];
            $currentPaid = [];
            $alreadyPaid = [];

            $deduction = 0;
            $deduction_type = null;
            $deductionReason = null;
            $advanceSalary = 0;

            $salaryMonth = Carbon::parse($request->salary_month)->format('Y-m');

            $employees = $this->employee->where('location_id', $this->location)->where('rate_type', 2)->orderBy('id')->get();
            if ($employees->count() > 0) {
                foreach ($employees as $employee) {
                    $salaryPaidRecord = $this->model->where('location_id', $this->location)
                        ->where('employee_id', $employee->id)->where('salary_month', $salaryMonth)->where('type', 1)->first();
                    $employeeName = $employee->full_name;
                    $employeeSalary = $employee->hrate;

                    if (empty($salaryPaidRecord)) { //salary not paid yet

                        //Loan Calculation
                        $loanRecords = \AccountHelper::employeeLoanRecords($employee->id, Carbon::parse($request->salary_month)->month, Carbon::parse($request->salary_month)->year);
                        if ($loanRecords['hasLoan'] === true) {

                            $deductionReason = 'Loan Deduction';
                            $deduction_type = 1;
                            if (!empty($loanRecords['monthRemain'])) {
                                if (($loanRecords['loanRemain'] - $loanRecords['monthRemain']) < 0) { //deduct whole remain amount
                                    $deduction = $loanRecords['loanRemain'];

                                    $employeeLoan = EmployeeLoan::where('location_id', $this->location)
                                        ->where('employee_id', $employee->id)->where('status', 4)->first();
                                    if ($employeeLoan) {
                                        $employeeLoan->status = 5;
                                        $employeeLoan->save();
                                    }

                                } else { //deduct installment
                                    $deduction = $loanRecords['monthRemain'];
                                }
                            } else {
                                if (($loanRecords['loanRemain'] - $loanRecords['deductAmount']) < 0) { //deduct whole remain amount
                                    $deduction = $loanRecords['loanRemain'];

                                    $employeeLoan = EmployeeLoan::where('location_id', $this->location)
                                        ->where('employee_id', $employee->id)->where('status', 4)->first();
                                    if ($employeeLoan) {
                                        $employeeLoan->status = 5;
                                        $employeeLoan->save();
                                    }
                                } else {
                                    $deduction = $loanRecords['deductAmount'];
                                }
                            }
                        } else {
                            $deduction = 0;
                            $deductionReason = null;
                            $deduction_type = null;
                        }

                        // Advance Salary Calculation
                        $salaryAdvanceRecord = $this->model->where('location_id', $this->location)->where('employee_id', $employee->id)
                            ->where('salary_month', $salaryMonth)->where('type', 2)
                            ->selectRaw('SUM(paid_salary) as advance_salary, created_at')->groupBy('created_at')->first();
                        if (!empty($salaryAdvanceRecord)) {
                            $advanceSalary = $salaryAdvanceRecord->advance_salary;
                            $paidSalary = (($employeeSalary - $deduction) - $advanceSalary);
                        } else {
                            $paidSalary = ($employeeSalary - $deduction);
                        }

                        if ($paidSalary > 0) {
                            $currentPaid[] = ['employee' => $employeeName, 'generated_date' => \AccountHelper::date_format(Carbon::today()->toDateString()) ];
                            $this->model->create([
                                'salary_no' => Prefixes::generateNumber('Salary'),
                                'employee_id' => $employee->id,
                                'salary_month' => $salaryMonth,
                                'total_salary' => $employeeSalary,
                                'paid_salary' => $paidSalary,
                                'attendance' => 31,
                                'present' => 31,
                                'deduction' => $deduction,
                                'deduction_type' => $deduction_type,
                                'deduction_reason' => $deductionReason,
                                'generated_by' => auth()->user()->id,
                                'type' => 1, //Salary
                                'status' => 'Pending',
                                'location_id' => $this->location,
                            ]);
                        } else {
                            $alreadyPaid[] = ['employee' => $employeeName, 'generated_date' => \AccountHelper::date_format($salaryAdvanceRecord->created_at) ];
                        }
                    } else {
                        $alreadyPaid[] = ['employee' => $employeeName, 'generated_date' => \AccountHelper::date_format($salaryPaidRecord->created_at) ];
                    }
                }
            }
            $finalOutput['currentRecords'] = $currentPaid;
            $finalOutput['alreadyRecords'] = $alreadyPaid;

            return $finalOutput;
        } else {
            $this->model->create([
                'salary_no' => Prefixes::generateNumber('Salary'),
                'employee_id' => $request->employee_id,
                'salary_month' => $request->salary_month,
                'total_salary' => $request->total_salary,
                'paid_salary' => $request->paid_salary,
                'attendance' => 1,
                'present' => 1,
                'deduction' => $request->deduction,
                'deduction_type' => 3,
                'deduction_reason' => $request->deduction_reason,
                'generated_by' => auth()->user()->id,
                'type' => 3, //Daily Wage
                'status' => 'Pending',
                'location_id' => $this->location,
            ]);

            return redirect()->route('dashboard.accounts.salary_generate.index')->with('success', trans('accounts.salary.add'));
        }
    }

    public function getDailyWage(Request $request){
        $output = ['success' => false, 'salary' => 0];

        $employeeID = $request->employee_id;
        $employee = $this->employee->where('location_id', $this->location)->findorFail($employeeID);

        $salaryDate = $request->date;

        $alreadyPaidSalary = $this->model->where('location_id', $this->location)->selectRaw('sum(paid_salary) salary')
            ->where(['salary_month' => $salaryDate,'employee_id' => $employee->id])->first();
        if (!empty($alreadyPaidSalary)) {
            $output = ['success' => true, 'salary' => ($employee->hrate - $alreadyPaidSalary->salary)];
        } else {
            $output = ['success' => true, 'salary' => $employee->hrate];
        }

        return $output;
    }

    public function advanceSalaryForm(){

        $this->authorize('advanceSalary', $this->model);

        $employees = $this->employee->where('location_id', $this->location)
            ->where('rate_type', 2)->get()->sortBy('full_name')->pluck('full_name','id');
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Salary' => route('dashboard.accounts.salary_generate.index'),
            'Advance Salary' => ''
        ]);

        $page_title = "Advance Salary";
        return view('dashboard.accounts.Human-Resource.Payroll.advance_salary_form',compact('page_title', 'breadcrumbs','employees'));
    }
    public function calcAdvanceSalary($id,$month){
        $employee = $this->employee->where('location_id', $this->location)->findorFail($id);
        $employeeSalary = $employee->hrate;
        $loanAmount = 0;
        $checkMonth = Carbon::parse($month)->format('Y-m');

        $advanceSalary = $this->model->where('location_id', $this->location)
            ->where('employee_id', $employee->id)->where('type', 2)
            ->where('salary_month', $checkMonth)
            ->selectRaw('SUM(paid_salary) advance')
            ->first();

        $salary = $this->model->where('location_id', $this->location)
            ->where('employee_id', $employee->id)->where('type', 1)
            ->where('salary_month', $checkMonth)
            ->selectRaw('SUM(paid_salary) salary')
            ->first();

        $loanRecords = \AccountHelper::employeeLoanRecords($employee->id, Carbon::parse($month)->month, Carbon::parse($month)->year);
        if ($loanRecords['hasLoan']) {
            if (!empty($loanRecords['monthRemain'])) {
                if (($loanRecords['loanRemain'] - $loanRecords['monthRemain']) < 0) { //deduct whole remain amount
                    $loanAmount = $loanRecords['loanRemain'];
                } else {
                    $loanAmount = $loanRecords['monthRemain'];
                }
            } else {
                if (($loanRecords['loanRemain'] - $loanRecords['deductAmount']) < 0) { //deduct whole remain amount
                    $loanAmount = $loanRecords['loanRemain'];
                } else {
                    $loanAmount = $loanRecords['deductAmount'];
                }
            }
        }

        if (empty($salary->salary)) {
            if (empty($advanceSalary->advance)) {
                $remainingSalary = $employeeSalary;
            } else {
                $remainingSalary = ($employeeSalary - $advanceSalary->advance);
            }
        } else {
            if (empty($advanceSalary->advance)) {
                $remainingSalary = $employeeSalary;
            } else {
                $remainingSalary = ($salary->salary  - $advanceSalary->advance);
            }
        }

        $data = [
            'basic' => $employeeSalary,
            'advance' => $advanceSalary->advance,
            'remainingSalary' => $remainingSalary,
            'loan' => $loanAmount
        ];
        return $data;
    }

    public function generateAdvanceSalary(Request $request){

        $this->authorize('advanceSalary', $this->model);

        $deduction = null;
        $deduction_type = null;
        $deduction_reason = null;
        $salaryMonth = Carbon::parse($request->salary_month)->format('F-Y');

        if ($request->loan > 0) {
            $deduction = $request->loan;
            $deduction_type = 1; //Loan
            $deduction_reason = 'Loan Deduction';
        }

        $salary = $this->model->create([
            'salary_no' => Prefixes::generateNumber('Salary'),
            'employee_id' => $request->employee_id,
            'salary_month' => Carbon::parse($request->salary_month)->format('Y-m'),
            'total_salary' => $request->total_salary,
            'paid_salary' => $request->advance,
            'deduction' => $deduction,
            'deduction_type' => $deduction_type,
            'deduction_reason' => $deduction_reason,
            'generated_by' => auth()->user()->id,
            'type' => 2, //Advance
            'status' => 'Pending',
            'location_id' => $this->location,
        ]);
        Prefixes::updateNumber('Salary');
        /*$employeeName = $this->employee->getEmployeeName($request->employee_id);

        //Salary Amount Credit in Cash in Hand
        $salary->transactions()->save(
            new Transaction([
                'Vtype' => 'Salary',
                'VDate' => Carbon::now(),
                'COAID' => 1020101,
                'Narration' => 'Cash in Hand Credit against Employee ' . $employeeName . ' Advance Salary of ' . $salaryMonth,
                'Debit' => 0,
                'Credit' => $request->advance,
                'IsPosted' => 1,
                'created_by' => auth()->user()->id,
                'IsAppove' => 1
            ])
        );

        //Salary Amount Debit in Employee Head
        $salary->transactions()->save(
            new Transaction([
                'Vtype' => 'Salary',
                'VDate' => Carbon::now(),
                'COAID' => $headCode,
                'Narration' => 'Employee ' . $employeeName . ' Debit Against Advance Salary of ' . $salaryMonth,
                'Debit' => $request->advance,
                'Credit' => 0,
                'IsPosted' => 1,
                'created_by' => auth()->user()->id,
                'IsAppove' => 1
            ])
        );

        //Salary Amount Debit in Employee Salary Main Head 403
        $salary->transactions()->save(
            new Transaction([
                'Vtype'          => 'Salary',
                'VDate'          => Carbon::now(),
                'COAID'          => 403,
                'Narration'      => 'Employee ' . $employeeName . ' Debit Against Advance Salary of ' . $salaryMonth,
                'Debit'          => $salary->advance,
                'Credit'         => 0,
                'IsPosted'       => 1,
                'created_by'     => auth()->user()->id,
                'updated_by'     => auth()->user()->id,
                'IsAppove'       => 1
            ])
        );

        //Deduction Amount Credit in Employee Head
        if (!empty($deduction)) {
            $salary->transactions()->save(
                new Transaction([
                    'Vtype'          => 'Loan',
                    'VDate'          => Carbon::now(),
                    'COAID'          => $headCode,
                    'Narration'      => 'Employee ' . $employeeName . ' Credit Against Loan Deduction of ' . $salaryMonth,
                    'Debit'          => 0,
                    'Credit'         => $deduction,
                    'IsPosted'       => 1,
                    'created_by'     => auth()->user()->id,
                    'updated_by'     => auth()->user()->id,
                    'IsAppove'       => 1
                ])
            );
        }*/

        return redirect()->route('dashboard.accounts.salary_generate.index', ['salary_month' => $salaryMonth, 'type' => 2])->with('success', trans('accounts.salary.gen'));

    }

    public function salaryPayslip($id){

        $this->authorize('salaryPayslip', $this->model);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Salary' => route('dashboard.accounts.salary_generate.index'),
            'Salary Slip' => ''
        ]);

        $page_title = "Salary Slip";

        $payslip = $this->model->where('location_id', $this->location)->findorFail($id);

        return view("dashboard.accounts.Human-Resource.Payroll.payslip",compact('payslip', 'page_title', 'breadcrumbs'));
    }

    public function salaryPaynow(Request $request){
        $output = ['success' => false, 'msg' => __('accounts.messages.something_went_wrong')];
        if (Auth::user()->can('salaryPayment', $this->model)) {
            $salary = $this->model->where('location_id', $this->location)->findorFail($request->salary_id);
            $salaryMonth = Carbon::parse($salary->salary_month)->format('F-Y');

            $employeeName = $this->employee->where('location_id', $this->location)->find($salary->employee_id)->full_name;
            $employeeHeadCode = AccountHead::where('employee_id', $salary->employee_id)->value('HeadCode');

            $salary->status = "Paid";
            $salary->received_by = $request->received_by;
            $salary->paid_by = auth()->user()->id;
            $salary->paid_at = Carbon::now();
            $salary->save();

            //Salary Amount Debit in Employee Head
            $salary->transactions()->save(
                new Transaction([
                    'Vtype' => 'Salary',
                    'VDate' => Carbon::now(),
                    'COAID' => $employeeHeadCode,
                    'Narration' => 'Employee ' . $employeeName . ' Debit Against ' . ($salary->type === 2 ? 'Advance ' : '') . 'Salary of ' . $salaryMonth,
                    'Debit' => $salary->paid_salary,
                    'Credit' => 0,
                    'IsPosted' => 1,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                    'IsAppove' => 1,
                    'location_id' => $this->location,
                ])
            );

            //Salary Amount Credit in Cash in Hand
            $salary->transactions()->save(
                new Transaction([
                    'Vtype' => 'Salary',
                    'VDate' => Carbon::now(),
                    'COAID' => 1020101,
                    'Narration' => 'Cash in Hand Credit against Employee ' . $employeeName . ($salary->type === 2 ? 'Advance ' : '') . 'Salary of ' . $salaryMonth,
                    'Debit' => 0,
                    'Credit' => $salary->paid_salary,
                    'IsPosted' => 1,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                    'IsAppove' => 1,
                    'location_id' => $this->location,
                ])
            );
            //Salary Amount Debit in Employee Salary Main Head 403
            $salary->transactions()->save(
                new Transaction([
                    'Vtype' => 'Salary',
                    'VDate' => Carbon::now(),
                    'COAID' => 403,
                    'Narration' => 'Employee ' . $employeeName . ' Debit Against ' . ($salary->type === 2 ? 'Advance ' : '') . 'Salary of ' . $salaryMonth,
                    'Debit' => $salary->paid_salary,
                    'Credit' => 0,
                    'IsPosted' => 1,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                    'IsAppove' => 1,
                    'location_id' => $this->location,
                ])
            );

            //Deduction Amount Credit in Employee Head
            if (!empty($salary->deduction)) {
                if ($salary->deduction_type == 1) {
                    //Loan Deduction Credit in Employee Head
                    $salary->transactions()->save(
                        new Transaction([
                            'Vtype' => 'Loan',
                            'VDate' => Carbon::now(),
                            'COAID' => $employeeHeadCode,
                            'Narration' => 'Employee ' . $employeeName . ' Credit Against Loan Deduction of ' . $salaryMonth,
                            'Debit' => 0,
                            'Credit' => $salary->deduction,
                            'IsPosted' => 1,
                            'created_by' => auth()->user()->id,
                            'updated_by' => auth()->user()->id,
                            'IsAppove' => 1,
                            'location_id' => $this->location,
                        ])
                    );
                } else {

                }
            }

            $output['success'] = true;

        } else{
            $output['msg'] = 'You are not allowed to perform this action.';
        }
        return $output;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', $this->model);

        $salaries = $this->model->where('location_id', $this->location);
        if ($request->filled('salary_month')) {
            $salaryMonth = Carbon::parse($request->salary_month)->format('Y-m');
            $salaries = $salaries->where('salary_month', $salaryMonth);
        }
        if ($request->filled('type')) {
            $salaries = $salaries->where('type', $request->type);
        }
        $salaries = $salaries->orderBy('salary_month', 'DESC')->get();

        $employees = $this->employee->where('location_id', $this->location)->get()->sortBy('full_name')->pluck('full_name', 'id');

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Salary' => '',
        ]);

        $page_title = "Manage Salary";

        return view('dashboard.accounts.Human-Resource.Payroll.manage_salary_generate',compact('page_title', 'breadcrumbs','salaries','employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
        return view('dashboard.accounts.Human-Resource.Payroll.salary_generate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(404);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
    }
}
