<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-4">
                {!!  HTML::decode(Form::label('supplier_id' ,trans('accounts.general.supplier') . '<i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
            </div>
            <div class="col-md-8 input-group">
                {!!  Form::select('supplier_id', $supplier, isset($for) ? $model->supplier_id : null,['id'=>'supplier_id',
                    'class'=>'select2 form-control', 'style' => 'width: 82%;',
                    'onchange'=>'getSupplierBalance(this, "amount_balance", null, "amount_span");',
                    'placeholder'=>'Select Supplier','required'=>''])
                !!}
                @empty($for)
                <div class="input-group-append">
                    <button type="button"  class="btn btn-success waves-effect waves-light"  data-toggle="modal" data-target="#supplier_add_modal"> <i class="ti-plus m-r-2"></i></button>
                </div>
                @endempty
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-4">
                {!!  HTML::decode(Form::label('purchase_date' ,trans('accounts.general.date') . '<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            </div>
            <div class="col-md-8 input-group">
                {!!  Form::text('purchase_date',isset($for) ? \AccountHelper::date_format($model->purchase_date) : \AccountHelper::date_format( \Carbon\Carbon::today()),['id'=>'purchase_date','class'=>'form-control datepicker','required','autocomplete'=>'off']) !!}
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
                {!!  HTML::decode(Form::label('chalan_no' ,trans('accounts.general.invoice_no') . '<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            </div>
            <div class="col-md-8">
                {!!  Form::text('chalan_no',isset($for) ? $model->chalan_no : $invoiceNumber,['id'=>'chalan_no','class'=>'form-control ','placeholder'=>trans('accounts.general.invoice_no'),'readonly', 'tabindex' => '-1']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-4">
                {!!  Form::label('purchase_details' ,trans('accounts.purchase.purchase_details') ,['class'=>'col-form-label text-right'])   !!}
            </div>
            <div class="col-md-8">
                {!! Form::textarea('purchase_details',isset($for) ? $model->purchase_details : null,['class' => 'form-control', 'size' => '30x1','placeholder'=>trans('accounts.purchase.purchase_details')]) !!}
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

<div class="row mb-2">
    <div class="col-md-6">
        @empty($for)
        <button type="button" class="btn btn-success btn-sm waves-effect waves-light" data-toggle="modal" data-target="#product_add_modal"><i class="fas fa-plus-circle m-r-2"></i> Add New Product</button>
        @endempty
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-4">
                {!!  HTML::decode(Form::label('payment_account' ,trans('accounts.general.attachment'),['class'=>'col-form-label text-right']))   !!}
            </div>
            <div class="col-md-8">
                @if(isset($for))
                    {!!  Form::file('attachment',['id'=>'attachment','class'=>'form-control dropify', 'data-height' => '70', 'data-max-file-size' => '3M', 'data-allowed-file-extensions' => 'png bmp gif jpg jpeg pdf', 'data-default-file'=>asset($model->attachment)]) !!}
                @else
                    {!!  Form::file('attachment',['id'=>'attachment','class'=>'form-control dropify', 'data-height' => '70', 'data-max-file-size' => '3M', 'data-allowed-file-extensions' => 'png bmp gif jpg jpeg pdf']) !!}
                @endif
            </div>
        </div>
    </div>
</div>

