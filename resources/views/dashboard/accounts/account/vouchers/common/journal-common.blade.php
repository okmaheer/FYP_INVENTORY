@if(isset($for))
    @if(count($voucherInfo))
    <div class="form-group row">
        <div class="col-sm-2">
            {!!  Form::label('voucher_no' ,'Voucher No' ,['class'=>'col-form-label'])   !!}
        </div>
        <div class="col-sm-10">
            {!!  Form::text('voucher_no',$voucherInfo[0]->VNo,['id'=>'voucher_no','class'=>'form-control ','placeholder'=>'"DV-2','readonly', 'tabindex'=>'-1']) !!}

        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-2">
            {!!  Html::decode(Form::label('date' ,'Date   <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}
        </div>
        <div class="col-sm-10 input-group">
            {!!  Form::text('date',\AccountHelper::date_format($voucherInfo[0]->VDate),['id'=>'date','class'=>'form-control datepicker','required', 'autocomplete'=>'off']) !!}
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">
            {!!  Form::label('remarks' ,'Remarks' ,['class'=>'col-form-label'])   !!}
        </div>
        <div class="col-sm-10">
            {!! Form::textarea('remarks',$voucherInfo[0]->Narration,['class' => 'form-control', 'size' => '50x2','placeholder'=>'Remark']) !!}
        </div>
    </div>

    <table id="debtAccVoucher" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
            <th class="text-center">Account Name<i class="text-danger"> *</i></th>
            <th class="text-center">Code</th>
            <th class="text-center">Debit</th>
            <th class="text-center">Credit</th>
            <th class="text-center">Action</th>

        </tr>
        </thead>

        <tbody id="debitvoucher">
        @php $totalDebit = $totalCredit = 0; @endphp
        @foreach($voucherInfo as $data)
            @php $totalCredit += $data->Credit; $totalDebit += $data->Debit; @endphp
        <tr id="row">
            <td  width="200">

                {!!  Form::select('cmbCode[]',AccountHelper::getAccountHeadVouchers(),$data->COAID,['id'=>'cmbCode_1',
                    'class'=>'select2 form-control mb-3 custom-select float-right',
                    'placeholder'=>'Account Heads' ,'onchange' => 'load_dbtvouchercode(this.value,1)','required'])
                !!}


            </td>
            <td>
                {!!  Form::text('txtCode[]',$data->COAID,['id'=>'txtCode_1','class'=>'form-control ','readonly','tabindex'=>'-1']) !!}

            </td>
            <td>
                {!!  Form::number('txtAmount[]',$data->Debit,['step'=>'any','min'=>'1','id'=>'txtAmount_1','class'=>'form-control total_price text-right' ,'onkeyup'=>'calculationContravoucher(1)','autocomplete'=>'off']) !!}

            </td>
            <td>
                {!!  Form::number('txtAmountcr[]',$data->Credit,['step'=>'any','min'=>'1','id'=>'txtAmount1_1','class'=>'form-control total_price1 text-right' ,'onkeyup'=>'calculationContravoucher(1)','autocomplete'=>'off']) !!}

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
            <td colspan="1" class="text-right">
                Total
            </td>
            <td>
                {!!  Form::text('grand_total',$totalDebit,['id'=>'grandTotal','class'=>'form-control ','readonly','tabindex'=>'-1']) !!}
            </td>
            <td>
                {!!  Form::text('grand_total1',$totalCredit,['id'=>'grandTotal1','class'=>'form-control ','readonly','tabindex'=>'-1']) !!}
            </td>
            <td>
                <button id="add_more" class="btn btn-info" type="button" value="Plus" aria-invalid="false" onClick="addaccountContravoucher('debitvoucher')">
                    <i class="fa fa-plus"></i>
                </button>
            </td>
        </tr>
        </tfoot>
    </table>
    @endif
@else
    <div class="form-group row">
        <div class="col-sm-2">
            {!!  Form::label('voucher_no' ,'Voucher No' ,['class'=>'col-form-label'])   !!}
        </div>
        <div class="col-sm-10">
            {!!  Form::text('voucher_no',$vocherNo,['id'=>'voucher_no','class'=>'form-control ','placeholder'=>'"DV-2','readonly','tabindex'=>'-1']) !!}

        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-2">
            {!!  Html::decode(Form::label('date' ,'Date   <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}

        </div>
        <div class="col-sm-10 input-group">
            {!!  Form::text('date',\AccountHelper::date_format(\Carbon\Carbon::today()),['id'=>'date','class'=>'form-control datepicker','required', 'autocomplete'=>'off']) !!}
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">
            {!!  Form::label('remarks' ,'Remarks' ,['class'=>'col-form-label'])   !!}
        </div>
        <div class="col-sm-10">
            {!! Form::textarea('remarks',null,['class' => 'form-control', 'size' => '50x2','placeholder'=>'Remark']) !!}
        </div>
    </div>

    <table id="debtAccVoucher" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
            <th class="text-center">Account Name<i class="text-danger"> *</i></th>
            <th class="text-center">Code</th>
            <th class="text-center">Debit</th>
            <th class="text-center">Credit</th>
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
                {!!  Form::number('txtAmount[]',null,['id'=>'txtAmount_1','class'=>'form-control total_price text-right' ,'onkeyup'=>'calculationContravoucher(1)','autocomplete'=>'off']) !!}

            </td>
            <td>
                {!!  Form::number('txtAmountcr[]',null,['id'=>'txtAmount1_1','class'=>'form-control total_price1 text-right' ,'onkeyup'=>'calculationContravoucher(1)','autocomplete'=>'off']) !!}

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
            <td colspan="1" class="text-right">
                Total
            </td>
            <td>
                {!!  Form::text('grand_total',null,['id'=>'grandTotal','class'=>'form-control ','readonly','tabindex'=>'-1']) !!}
            </td>
            <td>
                {!!  Form::text('grand_total1',null,['id'=>'grandTotal1','class'=>'form-control ','readonly','tabindex'=>'-1']) !!}
            </td>
            <td>
                <button id="add_more" class="btn btn-info" type="button" value="Plus" aria-invalid="false" onClick="addaccountContravoucher('debitvoucher')">
                    <i class="fa fa-plus"></i>
                </button>
            </td>
        </tr>
        </tfoot>
    </table>
@endif

