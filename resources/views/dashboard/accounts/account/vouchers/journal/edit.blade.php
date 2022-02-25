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
                                <h4 class="p-3 text-success">Journal Voucher</h4>
                                @include('includes.messages')
                            </div>
                            <div class="card-body">

                                <div class="general-label">
                                    {!! Form::model($voucherInfo,['route' => ['dashboard.accounts.journal.voucher.update',$voucherInfo[0]->VNo], 'files' => true, 'class' => 'solid-validation'] ) !!}
                                    {!! csrf_field() !!}
                                    @method('PATCH')

                                    @include('dashboard.accounts.account.vouchers.common.journal-common',['for'=>'edit'])

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
                &nbsp;{{-- complete account heads list --}}
                <input type="hidden" id="headoption" value='<?php if (AccountHelper::getAccountHeadVouchers()) { ?><?php foreach(AccountHelper::getAccountHeadVouchers() as $key => $value){?><option value="<?php echo $key ; ?>"><?php echo $value; ?></option><?php }}?>' name="">&nbsp;
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
