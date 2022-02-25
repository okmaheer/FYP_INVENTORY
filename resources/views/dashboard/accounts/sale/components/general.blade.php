<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-4">
                {!!  Html::decode(Form::label('customer_id', __("accounts.general.customer") . '<i class="text-danger">*</i>' ,['class'=>'col-form-label text-left']))   !!}
            </div>
            <div class="col-sm-8 input-group">
                {!!  Form::select('customer_id', $customer, isset($for) ? $model->customer_id : null, ['id'=>'customer_id',
                        'class'=>'select2 form-control', 'style'=>'width:82%',
                        'onchange'=>'getCustomerBalance(this, "amount_balance", null, "amount_span");',
                        'placeholder'=>'Select Customer', 'required'=>''])
                !!}
                @empty($for)
                <div class="input-group-append">
                    <button type="button"  class="btn btn-success waves-effect waves-light"  data-toggle="modal" data-target="#customer_add_modal"> <i class="ti-plus m-r-2"></i></button>
                </div>
                @endempty
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-4">
                {!!  Html::decode(Form::label('date' , __('accounts.general.date') . '<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            </div>
            <div class="col-sm-8 input-group">
                {!!  Form::text('date',isset($for) ? \AccountHelper::date_format($model->date) : \AccountHelper::date_format(\Carbon\Carbon::today()), ['id'=>'date','class'=>'form-control datepicker','required','autocomplete'=>'off']) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-4">
                {!!  Html::decode(Form::label('invoice_no' , __('accounts.general.invoice_no') . '<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            </div>
            <div class="col-sm-8">
                {!!  Form::text('invoice_no',isset($for) ? $model->invoice_no : $invoiceNumber, ['id'=>'invoice_no','class'=>'form-control ','placeholder'=>'','readonly', 'tabindex'=>'-1']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-4">
                {!!  Form::label('invoice_details' ,trans('accounts.general.details') ,['class'=>'col-form-label text-right'])   !!}
            </div>
            <div class="col-md-8">
                {!! Form::textarea('invoice_details',isset($for) ? $model->invoice_details : null,['class' => 'form-control', 'size' => '30x1','placeholder'=>trans('accounts.general.details')]) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-4">
                {!!  HTML::decode(Form::label('payment_type' ,trans('accounts.general.payment_type') . '<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            </div>
            <div class="col-md-8">
                {!!  Form::select('payment_type', $paymentTypes, isset($for) ? $model->payment_type : 1,['id'=>'payment_type',
                    'class'=>'select2 form-control', 'style' => 'width: 100%;',
                    'placeholder'=>'Select Payment Type','required'])
                !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-4">
                {!!  HTML::decode(Form::label('payment_account' ,trans('accounts.general.payment_account') . '<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            </div>
            <div class="col-md-8">
                {!!  Form::select('payment_account', $paymentAccounts, isset($for) ? $model->payment_account : null,['id'=>'payment_account',
                    'class'=>'select2 form-control', 'style' => 'width: 100%;',
                    'placeholder'=>'Select Payment Account','required'])
                !!}
            </div>
        </div>
    </div>
</div>
