{!! Form::open(['route' => 'employee.loan.status', 'files' => true, 'id' => 'loan_details_form'] ) !!}
{!! Form::hidden('loan_id',$loan->id)  !!}

<div class="modal-header">
    <h5 class="modal-title mt-0" id="myModalLabel">{{ __('accounts.employee_loan.add_loan') }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-4">
            <h6>{{ __('accounts.general.employee') }}:</h6>
        </div>
        <div class="col-md-7 bg-soft-primary rounded">
            <h6 class="font-weight-bold">{{ $loan->employee->full_name }} [{{ $loan->employee->designation->name }}]</h6>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-4">
            <h6>{{ __('accounts.employee_loan.loan_amount') }}:</h6>
        </div>
        <div class="col-md-7 bg-soft-primary rounded">
            <h6 class="font-weight-bold">{{ \AccountHelper::number_format( $loan->loan_amount ) }}</h6>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-4">
            <h6>{{ __('accounts.employee_loan.request_date') }}:</h6>
        </div>
        <div class="col-md-7 bg-soft-primary rounded">
            <h6 class="font-weight-bold">{{ \AccountHelper::date_format( $loan->date ) }}</h6>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-4">
            <h6>{{ __('accounts.employee_loan.return_type') }}:</h6>
        </div>
        <div class="col-md-7 bg-soft-primary rounded">
            <h6 class="font-weight-bold">{{ \AccountHelper::loanReturnTypes( $loan->return_type ) }}</h6>
        </div>
    </div>
    @if ($loan->return_type === 1)
        <div class="row mt-1">
            <div class="col-md-4">
                <h6>{{ __('accounts.employee_loan.return_date') }}:</h6>
            </div>
            <div class="col-md-7 bg-soft-primary rounded">
                <h6 class="font-weight-bold">{{ \AccountHelper::date_format( $loan->return_date ) }}</h6>
            </div>
        </div>
    @endif
    @if($loan->status == 1 && \Auth::user()->can('requestApproval', \App\Models\EmployeeLoan::class))
        <div class="row mt-1">
            <div class="col-md-4">
                <h6>{{ __('accounts.general.status') }}:</h6>
            </div>
            <div class="col-md-7">
                {!!  Form::select('status',\AccountHelper::loanStatus(),$loan->status,['id'=>'status',
                    'class'=>'select2 form-control', 'style' => 'width:100%'])
                !!}
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-4">
                <h6>{{ __('accounts.employee_loan.status_details') }}:</h6>
            </div>
            <div class="col-md-7">
                {!!  Form::textarea('status_details',null,['id'=>'status_details',
                    'class'=>'form-control', 'size' => '30x2'])
                !!}
            </div>
        </div>
    @else
        <div class="row mt-1">
            <div class="col-md-4">
                <h6>{{ __('accounts.general.status') }}:</h6>
            </div>
            <div class="col-md-7 bg-soft-primary rounded">
                <h6 class="font-weight-bold">
                    @if ($loan->status === 4)
                        In Receiving
                    @elseif ($loan->status === 5)
                        Returned
                    @else
                    {{ \AccountHelper::loanStatus( $loan->status ) }}
                    @endif
                </h6>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-4">
                <h6>{{ __('accounts.employee_loan.status_details') }}:</h6>
            </div>
            <div class="col-md-7">
                {!!  Form::textarea('status_details',$loan->status_details,['id'=>'status_details',
                    'class'=>'form-control', 'size' => '30x2', 'readonly'])
                !!}
            </div>
        </div>
    @endif

</div>
<div class="modal-footer">
    @if ($loan->status == 1)
        @include('dashboard.accounts.common.buttons.buttons-crud', ['update' => true])
    @else
        <a href="javascript:void(0);" class="btn btn-success w-md" data-dismiss="modal">Cancel</a>
    @endif
</div>
{!! Form::close() !!}
