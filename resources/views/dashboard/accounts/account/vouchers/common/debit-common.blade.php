@if(isset($for))
    @if(count($creditInfo))

        <div class="form-group row">
            <div class="col-sm-3">
                {!!  Form::label('voucher_no' ,'Voucher No' ,['class'=>'col-form-label'])   !!}
            </div>
            <div class="col-sm-9">
                {!!  Form::text('voucher_no',$creditInfo[0]->VNo,['id'=>'voucher_no','class'=>'form-control ','placeholder'=>'"DV-2','readonly', 'tabindex'=>'-1']) !!}

            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-3">
                {!!  Html::decode(Form::label('cmbDebit' ,'Credit Account Head  <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}
            </div>
            <div class="col-sm-9">
                {!!  Form::select('cmbDebit',AccountHelper::getAccountHeadVouchers(),$creditInfo[0]->COAID,['id'=>'cmbDebit',
                    'class'=>'select2 form-control mb-3 custom-select float-right', 'style'=>'width: 100%','required'])
                !!}

            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3">
                {!!  Html::decode(Form::label('date' ,'Date   <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}

            </div>
            <div class="col-sm-9 input-group">
                {!!  Form::text('date',\AccountHelper::date_format(\Carbon\Carbon::today()),['id'=>'date','class'=>'form-control datepicker','autocomplete'=>'off','required']) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3">
                {!!  Form::label('remarks' ,'Remarks' ,['class'=>'col-form-label'])   !!}
            </div>
            <div class="col-sm-9">
                {!! Form::textarea('remarks',null,['class' => 'form-control', 'size' => '50x2','placeholder'=>'Remark']) !!}
            </div>
        </div>

        <table id="debtAccVoucher" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
            <tr>
                <th class="text-center">Account Name<i class="text-danger"> *</i></th>
                <th class="text-center">Code</th>
                <th class="text-center">Amount <i class="text-danger"> *</i></th>
                <th class="text-center">Action</th>

            </tr>
            </thead>

            <tbody id="debitvoucher">
            @php $total = 0; @endphp
            @foreach($dbvoucherInfo as $data)
                @php $total += $data->Debit; @endphp
            <tr id="row">
                <td  width="200">

                    {!!  Form::select('cmbCode[]',AccountHelper::getAccountHeadVouchers(),$data->COAID,['id'=>'cmbCode_1',
                        'class'=>'select2 form-control mb-3 custom-select float-right',
                        'placeholder'=>'Account Heads' ,'onchange' => 'load_dbtvouchercode(this.value,1)','required'])
                    !!}


                </td>
                <td>
                    {!!  Form::text('txtCode[]',$data->COAID,['id'=>'txtCode_1','class'=>'form-control ','readonly', 'tabindex'=>'-1']) !!}

                </td>
                <td>
                    {!!  Form::number('txtAmount[]',$data->Debit,['step'=>'any','min'=>'1','id'=>'txtAmount_1','class'=>'form-control total_price text-right' ,'onkeyup'=>'dbtvouchercalculation(1)','autocomplete'=>'off']) !!}

                </td>
                <td>
                    <button class="btn delete-row btn-danger red text-right valid" type="button" value="Delete" aria-invalid="false">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td>

                </td>
                <td class="text-right">
                    Total
                </td>
                <td>
                    {!!  Form::text('grand_total',$total,['id'=>'grandTotal','class'=>'form-control ','readonly','tabindex'=>'-1']) !!}

                </td>
                <td>
                    <button id="add_more" class="btn btn-info" type="button" value="Plus" aria-invalid="false" onClick="addaccountdbt('debitvoucher')">
                        <i class="fa fa-plus"></i>
                    </button>
                </td>
            </tr>
            </tfoot>
        </table>

    @endif

@else
    <div class="form-group row">
        <div class="col-sm-3">
            {!!  Form::label('voucher_no' ,'Voucher No' ,['class'=>'col-form-label'])   !!}
        </div>
        <div class="col-sm-9">
            {!!  Form::text('voucher_no',$vocherNo,['id'=>'voucher_no','class'=>'form-control ','placeholder'=>'"DV-2','readonly','tabindex'=>'-1']) !!}

        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-3">
            {!!  Html::decode(Form::label('cmbDebit' ,'Credit Account Head  <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}
        </div>
        <div class="col-sm-9">
            {!!  Form::select('cmbDebit',$cih,null,['id'=>'cmbDebit',
                'class'=>'select2 form-control mb-3 custom-select float-right','style'=>'width:100%','required'])
            !!}

        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3">
            {!!  Html::decode(Form::label('date' ,'Date   <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}

        </div>
        <div class="col-sm-9 input-group">
            {!!  Form::text('date',\AccountHelper::date_format(\Carbon\Carbon::today()),['id'=>'date','class'=>'form-control datepicker','autocomplete'=>'off','required']) !!}
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3">
            {!!  Form::label('remarks' ,'Remarks' ,['class'=>'col-form-label'])   !!}
        </div>
        <div class="col-sm-9">
            {!! Form::textarea('remarks',null,['class' => 'form-control', 'size' => '50x2','placeholder'=>'Remark']) !!}
        </div>
    </div>

    <table id="debtAccVoucher" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
            <th class="text-center">Account Name<i class="text-danger"> *</i></th>
            <th class="text-center">Code</th>
            <th class="text-center">Amount <i class="text-danger"> *</i></th>
            <th class="text-center">Action</th>

        </tr>
        </thead>

        <tbody id="debitvoucher">
        <tr id="row">
            <td  width="400">

                {!!  Form::select('cmbCode[]',$accountHeads,null,['id'=>'cmbCode_1',
                'class'=>'select2 form-control mb-3 custom-select float-right',
                'placeholder'=>'Account Heads' ,'onchange' => 'load_dbtvouchercode(this.value,1)','required'])
                !!}


            </td>
            <td>
                {!!  Form::text('txtCode[]',null,['id'=>'txtCode_1','class'=>'form-control ','readonly','tabindex'=>'-1']) !!}

            </td>
            <td>
                {!!  Form::number('txtAmount[]',null,['step'=>'any','min'=>'1','id'=>'txtAmount_1','class'=>'form-control total_price text-right' ,'onkeyup'=>'dbtvouchercalculation(1)', 'required','autocomplete'=>'off']) !!}

            </td>
            <td>
                <button class="btn delete-row btn-danger red text-right valid" type="button" value="Delete" aria-invalid="false">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td>

            </td>
            <td class="text-right">
                Total
            </td>
            <td>
                {!!  Form::text('grand_total',null,['id'=>'grandTotal','class'=>'form-control ','readonly','tabindex'=>'-1']) !!}

            </td>
            <td>
                <button id="add_more" class="btn btn-info" type="button" value="Plus" aria-invalid="false" onClick="addaccountdbt('debitvoucher')">
                    <i class="fa fa-plus"></i>
                </button>
            </td>
        </tr>
        </tfoot>
    </table>

@endif
