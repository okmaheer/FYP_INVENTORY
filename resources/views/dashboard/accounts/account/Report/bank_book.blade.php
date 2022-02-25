@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@include('includes.dashboard-breadcrumbs')
@section('body')
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header bg-white">
                            <div class="row col-12">
                                {{-- {!! Form::open(['route' => 'supplier.store', 'files' => true] ) !!} --}}
                                {!! csrf_field() !!}
                                <h4 class="col-6">Search Record By</h4>
                                <div class="col-lg-6 text-right">
                                    <div class="btn-group">
                                        {!! Form::submit('Search', ['class' => 'btn btn-primary w-sm']) !!}
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span> <i
                                                class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            {!! Form::button('Print', ['class' => 'dropdown-item', 'id' => "printBtn"]) !!}
                                            {{-- <a href="{{ route($route) }}" class="dropdown-item">Clear</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="general-label">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="col-sm-12">
                                            {!! Html::decode(Form::label('credit_account_head', 'Credit Account Head   <i class="text-danger">*</i>', ['class' => ' col-form-label text-left'])) !!}
                                            {!! Form::select('credit_account_head', AccountHelper::manualStatus(), null, ['id' => 'credit_account_head', 'class' => 'select2 form-control mb-3 custom-select float-right', 'placeholder' => 'Select Option']) !!}
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="col-sm-12">
                                            {!! Form::label('voucher_no', 'Voucher No', ['class' => 'col-form-label']) !!}
                                            {!! Form::text('voucher_no', null, ['id' => 'voucher_no', 'class' => 'form-control ', 'placeholder' => '0.00', 'readonly']) !!}

                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="col-sm-12">
                                            {!! Html::decode(Form::label('from_date', 'Date   <i class="text-danger">*</i>', ['class' => ' col-form-label'])) !!}

                                            {!! Form::date('from_date', null, ['id' => 'from_date', 'class' => 'form-control ', 'placeholder' => '2021-04-03']) !!}

                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="col-sm-12">
                                            {!! Html::decode(Form::label('date', 'To Date   <i class="text-danger">*</i>', ['class' => ' col-form-label'])) !!}
                                            {!! Form::date('to_date', null, ['id' => 'to_date', 'class' => 'form-control ', 'placeholder' => '2021-04-03']) !!}

                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <!--end card-body-->
                    </div>
                </div>
            </div>
            <div class="card" id="printArea">
                <div class="card-body">
                    @include('includes.company-detail-header')
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table class="table table-striped table-bordered dt-responsive nowrap container-fluid"
                                cellpadding="6" cellspacing="1" width="100%">
                                <div class="table-title">

                                    <tbody>
                                        <tr class="table_data">
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-right" colspan="3"><strong>Opening Balance</strong></td>
                                            <td class="text-center"><strong>0.00</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">SL.</td>
                                            <td class="text-center">Date</td>
                                            <td class="text-center">Voucher No</td>
                                            <td class="text-center">Voucher Type</td>
                                            <td class="text-center">Remark</td>
                                            <td class="text-right">Debit</td>
                                            <td class="text-right">Credit</td>
                                            <td class="text-center">Balance</td>
                                        </tr>
                                        <tr class="table_data print-footercolor bg-primary">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-right text-white"><strong>Total</strong></td>
                                            <td class="text-right text-white">0.00</td>
                                            <td class="text-right text-white">0.00</td>
                                            <td class="text-center text-white">0.00</td>
                                        </tr>
                                    </tbody>



                                </div>

                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div><!-- container -->
        &nbsp;
        &nbsp;
        &nbsp;
        @include('includes.dashboard-footer')
    </div>

@endsection
@endsection

@section('innerScriptFiles')
<!-- Plugins js -->
<script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
@endsection
@section('innerScript')

<script>
    (function() {
        $('select').select2();
    })();
</script>


@endsection
