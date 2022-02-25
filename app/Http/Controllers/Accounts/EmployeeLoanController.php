<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\Employee;
use App\Models\EmployeeLoan;
use App\Models\Prefixes;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeLoanController extends Controller
{
    protected $model;
    protected $employees;
    protected $transactions;
    private $location;

    function __construct(EmployeeLoan $loan, Employee $employee, Transaction $transaction)
    {
        $this->middleware('auth');
        $this->model = $loan;
        $this->employees = $employee;
        $this->transactions = $transaction;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $this->authorize('view', $this->model);

        $breadcrumbs = collect([
            __('accounts.general.dashboard') => route('dashboard'),
            __('accounts.employee_loan.manage_loan') => '',
        ]);
        $page_title =  __('accounts.employee_loan.manage_loan');

        $records = $this->model->where('location_id', $this->location);

        $records = $records->get();

        return view('dashboard.accounts.Human-Resource.loan.index', compact('page_title', 'breadcrumbs', 'records'));
    }

    public function create()
    {
        $this->authorize('request', $this->model);

        $breadcrumbs = collect([
            __('accounts.general.dashboard') => route('dashboard'),
            __('accounts.employee_loan.manage_loan') => route('dashboard.accounts.employee_loan.index'),
            __('accounts.employee_loan.add_loan') => ''
        ]);
        $page_title = __('accounts.employee_loan.add_loan');

        $employees = $this->employees->where('location_id', $this->location)->get()->sortBy('full_name')->pluck('full_name', 'id');

        return view('dashboard.accounts.Human-Resource.loan.create', compact('page_title', 'breadcrumbs', 'employees'));
    }

    public function store(Request $request)
    {
        $this->authorize('request', $this->model);

        $this->model = $this->model->create($request->all());
        Prefixes::updateNumber('Loan');

        if ($this->model) {
            $this->model->status = 1;
            $this->model->requested_by = auth()->user()->id;
            $this->model->location_id = $this->location;
            $this->model->save();
        }

        return redirect()->route('dashboard.accounts.employee_loan.index')->with('success', __('accounts.messages.requested_loan_msg'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        abort(404);
        $breadcrumbs = collect([
            __('accounts.general.dashboard') => route('dashboard'),
            __('accounts.employee_loan.manage_loan') => route('dashboard.accounts.employee_loan.index'),
            __('accounts.employee_loan.edit_loan') => ''
        ]);
        $page_title = __('accounts.employee_loan.edit_loan');

        return view('dashboard.accounts.Human-Resource.loan.edit', compact('page_title', 'breadcrumbs',));
    }

    public function update(Request $request, $id)
    {
        abort(404);
    }

    public function destroy($id)
    {
        abort(404);
    }

    public function loanReport(Request $request) {
        $this->authorize('report', $this->model);

        $breadcrumbs = collect([
            __('accounts.general.dashboard') => route('dashboard'),
            __('accounts.employee_loan.manage_loan') => route('dashboard.accounts.employee_loan.index'),
            'Loan Report' => ''
        ]);
        $page_title = 'Loan Report';

        $report = $this->model->where('location_id', $this->location)->whereNotIn('status', [1, 2]);
        if ($request->filled('employee_id')) {
            $report = $report->where('employee_id', $request->employee_id);
        }
        if ($request->filled('status')) {
            $report = $report->where('status', $request->status);
        }
        $report = \QueryHelper::filterByDate($request,$report,'loan', 'employee_loan');
        $report = $report->orderBy('date', 'DESC')->get();

        $employees = $this->employees->where('location_id', $this->location)->get()->sortBy('full_name')->pluck('full_name', 'id');
        $status = \AccountHelper::loanStatus();
        $status[4] = 'In Receiving';
        $status[5] = 'Returned';

        return view('dashboard.accounts.Human-Resource.loan.report', compact('page_title', 'breadcrumbs', 'employees', 'status', 'report'));
    }

    public function loanReceive() {
        $this->authorize('receive', $this->model);

        $breadcrumbs = collect([
            __('accounts.general.dashboard') => route('dashboard'),
            __('accounts.employee_loan.manage_loan') => route('dashboard.accounts.employee_loan.index'),
            __('accounts.employee_loan.receive_loan') => ''
        ]);
        $page_title = __('accounts.employee_loan.receive_loan');

        $loanEmployees = $this->model->where('location_id', $this->location)
            ->with('employee')->where('return_type', 1)
            ->where('status', 4)->get()
            ->pluck('employee.full_name', 'employee.id');

        return view('dashboard.accounts.Human-Resource.loan.receive', compact('page_title', 'breadcrumbs', 'loanEmployees'));
    }

    public function loanReceiveData(Request $request) {
        $output = ['success' => false, 'msg' => '', 'loan_amount_display' => 0, 'loan_amount' => 0];
        if ($request->ajax()) {
            if ($request->filled('employee_id')) {
                $employee_id = $request->employee_id;
                $employee = $this->employees->where('location_id', $this->location)->findorFail($employee_id);
                $loanRemain = \AccountHelper::employeeLoanRemainAmount($employee->id);
                if ($loanRemain['remaining'] > 0) {
                    $output = ['success' => true, 'msg' => '', 'loan_amount_display' => \AccountHelper::number_format($loanRemain['remaining']), 'loan_amount' => $loanRemain['remaining']];
                }
            } else {
                $output['msg'] = 'Invalid employee passed in request.';
            }
        } else {
            $output['msg'] = __("accounts.messages.invalid_request");
        }

        return $output;
    }

    public function addLoanReceive(Request $request) {
        $this->authorize('receive', $this->model);

        $employee = $this->employees->where('location_id', $this->location)->findorFail($request->employee_id);
        $employeeName = $employee->full_name;
        $employeeHeadCode = AccountHead::where('employee_id', $employee->id)->value('HeadCode');

        $loan = $this->model->where('location_id', $this->location)
            ->where('employee_id', $employee->id)
            ->where('status', 4)->firstorFail();
        $loanRemain = \AccountHelper::employeeLoanRemainAmount($employee->id);

        if ($loanRemain['remaining'] == $request->amount_received) {
            $loan->status = 5;
            $loan->received_by = auth()->user()->id;
            $loan->received_at = Carbon::now();
            $loan->save();
        }

        //Cash in Hand Debit Against Received Amount
        $loan->transactions()->save(
            new Transaction([
                'Vtype'          => 'Loan',
                'VDate'          => Carbon::now(),
                'COAID'          => 1020101,
                'Narration'      => 'Cash in Hand Debit against Loan Receiving from Employee ' . $employeeName,
                'Debit'          => $request->amount_received,
                'Credit'         => 0,
                'IsPosted'       => 1,
                'created_by'     => auth()->user()->id,
                'updated_by'     => auth()->user()->id,
                'IsAppove'       => 1,
                'location_id'    => $this->location,
            ])
        );

        // Employee Head Credit Against Received Amount
        $loan->transactions()->save(
            new Transaction([
                'Vtype'          => 'Loan',
                'VDate'          => Carbon::now(),
                'COAID'          => $employeeHeadCode,
                'Narration'      => 'Employee ' . $employeeName . ' Credit Against Loan Receiving.',
                'Debit'          => 0,
                'Credit'         => $request->amount_received,
                'IsPosted'       => 1,
                'created_by'     => auth()->user()->id,
                'updated_by'     => auth()->user()->id,
                'IsAppove'       => 1,
                'location_id'    => $this->location,
            ])
        );

        if ($request->doPrint == 1) {
            return redirect()->route('common.payment.receipt', ['VNo' => $loan->loan_no, 'type' => 'Loan']);
        } else {
            return redirect()->route('employee.loan.receive')->with('success', __('accounts.employee_loan.loan_received_voucher'));
        }
    }

    public function getApplicableLoan(Request $request) {
        $output = ['success' => false, 'msg' => '', 'loan_amount_display' => 0, 'loan_amount' => 0, 'salary' => 0];

        if ($request->ajax()) {
            if ($request->filled('employee_id')) {
                $employee_id = $request->employee_id;
                $employee = $this->employees->where('location_id', $this->location)->findorFail($employee_id);

                if ($employee) {
                    $loan = $this->model->where('location_id', $this->location)->where('employee_id', $employee->id)->whereIn('status', [1,2,4])->get();
                    if ($loan->count() > 0) {
                        $output['msg'] = 'Employee is already enrolled in loan request or returning previous loan.';
                    } else {
                        if ($employee->loan_percentage > 0) {
                            $empSalary = $employee->hrate;
                            $loanPercentage = $employee->loan_percentage;

                            $applicableLoan = (($empSalary * $loanPercentage) / 100);
                            $output = ['success' => true, 'msg' => '', 'loan_amount' => $applicableLoan,
                                'loan_amount_display' => \AccountHelper::number_format($applicableLoan), 'salary' => $empSalary];
                        } else {
                            $output['msg'] = 'Employee loan percentage is not set.';
                        }
                    }
                } else {
                    $output['msg'] = 'Unable to fetch loan amount.';
                }
            } else {
                $output['msg'] = 'Invalid employee passed in request.';
            }
        } else {
            $output['msg'] = __("accounts.messages.invalid_request");
        }

        return $output;
    }

    public function getLoanDetails(Request $request) {
        if ($request->ajax()) {
            if ($request->has('loan_id')) {
                $loan = $this->model->where('location_id', $this->location)->findorFail($request->loan_id);
                return view('dashboard.accounts.Human-Resource.loan.components.details_model_content', compact('loan'))->render();
            }
        }
    }

    public function updateLoanStatus(Request $request) {
        $output = ['success' => false, 'msg' => ''];

        if(Auth::user()->can('requestApproval', $this->model)) {
            if ($request->ajax()) {
                if ($request->has('loan_id')) {
                    $loan = $this->model->where('location_id', $this->location)->findorFail($request->loan_id);
                    $loan->status = $request->status;
                    $loan->status_details = $request->status_details;
                    $loan->approved_by = auth()->user()->id;
                    $loan->approved_at = Carbon::now();
                    $loan->save();

                    $output['success'] = true;

                } else {
                    $output['msg'] = __('accounts.messages.something_went_wrong');
                }
            } else {
                $output['msg'] = __('accounts.messages.invalid_request');
            }
        } else {
            $output['msg'] = 'You are not allowed to perform this action.';
        }
        return $output;
    }

    public function payLoanAmount(Request $request) {
        $output = ['success' => false, 'msg' => ''];

        if(Auth::user()->can('loanPayment', $this->model)) {
            if ($request->ajax()) {
                if ($request->has('loan_id')) {
                    $loan = $this->model->where('location_id', $this->location)->findorFail($request->loan_id);
                    $loan->status = 4; //in receiving
                    $loan->save();

                    $employeeName = $this->employees->where('location_id', $this->location)->find($loan->employee_id)->full_name;
                    $employeeHeadCode = AccountHead::where('employee_id', $loan->employee_id)->value('HeadCode');

                    //Loan Amount Debit in Employee Head
                    $voucher = $loan->transactions()->save(
                        new Transaction([
                            'Vtype' => 'Loan',
                            'VDate' => Carbon::now(),
                            'COAID' => $employeeHeadCode,
                            'Narration' => 'Employee ' . $employeeName . ' Debit Against Loan Payment Ref # ' . $loan->loan_no,
                            'Debit' => $loan->loan_amount,
                            'Credit' => 0,
                            'IsPosted' => 1,
                            'created_by' => auth()->user()->id,
                            'updated_by' => auth()->user()->id,
                            'IsAppove' => 1,
                            'location_id' => $this->location,
                        ])
                    );

                    //Loan Amount Credit in Cash in Hand
                    $loan->transactions()->save(
                        new Transaction([
                            'Vtype' => 'Loan',
                            'VDate' => Carbon::now(),
                            'COAID' => 1020101,
                            'Narration' => 'Cash in Hand Credit for Loan Payment to ' . $employeeName . ' Ref # ' . $loan->loan_no,
                            'Debit' => 0,
                            'Credit' => $loan->loan_amount,
                            'IsPosted' => 1,
                            'created_by' => auth()->user()->id,
                            'updated_by' => auth()->user()->id,
                            'IsAppove' => 1,
                            'location_id' => $this->location,
                        ])
                    );
                    $output = ['success' => true, 'VNo' => $voucher->VNo];
                } else {
                    $output['msg'] = __('accounts.messages.something_went_wrong');
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
