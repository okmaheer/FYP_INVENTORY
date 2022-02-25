@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
<link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
    @include('includes.dashboard-breadcrumbs')
<style>

</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">

                        <div class="card">
                            <div class="penal-title  border-grey border-bottom">
                                <h4 class="p-3 text-success">Contra Voucher</h4>
                            </div>
                            <div class="card-body">

                                <div class="general-label">
                                    {!! Form::model($voucher,['route' => 'add.contra.voucher',$voucher->id, 'files' => true, 'class' => 'solid-validation'] ) !!}
                                    {!! csrf_field() !!}
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!!  Form::label('voucher_no' ,'Voucher No' ,['class'=>'col-form-label'])   !!}
                                        </div>
                                        <div class="col-sm-10">
                                            {!!  Form::text('VNo',null,['id'=>'voucher_no','class'=>'form-control ','placeholder'=>'"DV-2','readonly','autocomplete'=>'off']) !!}

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!!  Html::decode(Form::label('date' ,'Date   <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}

                                        </div>
                                        <div class="col-sm-10">
                                            {!!  Form::date('VDate',null,['id'=>'date','class'=>'form-control ','placeholder'=>'2021-03-06','required']) !!}

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!!  Form::label('remarks' ,'Remarks' ,['class'=>'col-form-label'])   !!}
                                        </div>
                                        <div class="col-sm-10">
                                            {!! Form::textarea('Narration',null,['class' => 'form-control', 'size' => '50x2','placeholder'=>'Remark']) !!}
                                        </div>
                                    </div>
                                    @if ($voucher->Vtype == 'Contra' or $voucher->Vtype == 'JV')
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
                                            <td  width="200">

                                                {!!  Form::select('cmbCode[]',$accountHeads,null,['id'=>'cmbCode_1',
                                                'class'=>'select2 form-control mb-3 custom-select float-right',
                                                'placeholder'=>'Account Heads' ,'onchange' => 'load_dbtvouchercode(this.value,1)','required'])
                                                !!}


                                            </td>
                                            <td>
                                                {!!  Form::text('txtCode[]',null,['id'=>'txtCode_1','class'=>'form-control ','readonly','autocomplete'=>'off']) !!}

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
                                                {!!  Form::text('grand_total',null,['id'=>'grandTotal','class'=>'form-control ','readonly','autocomplete'=>'off']) !!}
                                            </td>
                                            <td>
                                                {!!  Form::text('grand_total1',null,['id'=>'grandTotal1','class'=>'form-control ','readonly','autocomplete'=>'off']) !!}
                                            </td>
                                            <td>
                                                <button id="add_more" class="btn btn-info" type="button" value="Plus" aria-invalid="false" onClick="addaccountContravoucher('debitvoucher')">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    @else


                                    @endif

                                    <div class="row">
                                        <div class="col-sm-12 text-right">
                                            {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}

                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->


                </div>

                <!-- container -->
                {{-- complete account heads list --}}
                <input type="hidden" id="headoption" value='<?php if ($accountHeads) { ?><?php foreach($accountHeads as $key => $value){?><option value="<?php echo $key ; ?>"><?php echo $value; ?></option><?php }}?>' name="">&nbsp;
                &nbsp;
                &nbsp;

               @include('includes.dashboard-footer')
            </div>

    @endsection
        @endsection

        @section('innerScriptFiles')
        <!-- Plugins js -->
        <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('js/admin_js/account.js') }}"></script>
        @endsection
        @section('innerScript')
            <script type="text/javascript">
                var base_url = '{{ url('/')}}';
            </script>
            <script>
                (function (){
                    $('select').select2();
                })();
            </script>


        @endsection
