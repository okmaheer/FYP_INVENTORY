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
                            @include('includes.messages')
                            <div class="penal-title  border-grey border-bottom">
                                <h4 class="p-3 text-dark">Contra Voucher</h4>
                            </div>
                            <div class="card-body">

                                <div class="general-label">
                                    {!! Form::open(['route' => 'dashboard.accounts.contra.voucher.store', 'files' => true, 'id'=>'voucher_form', 'class' => 'solid-validation'] ) !!}

                                    @include('dashboard.accounts.account.vouchers.common.contra-common')

                                    @include('dashboard.accounts.common.buttons.buttons-crud', ['save'=>true, 'save_print'=>true, 'form_id'=>'voucher_form'])
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->


                </div>

                <!-- container -->
                {{-- complete account heads list --}}
                <input type="hidden" id="headoption" value="
                    @php
                        if ($accountHeads) {
                            $values = "";
                            foreach($accountHeads as $key => $value) {
                                $values .= "<optgroup label='" . $key . "'>\n";
                                foreach ($value as $key2 => $value2) {
                                    $values .= "<option value='" . $key2 . "'>" . $value2 . "</option>\n";
                                }
                                $values .= "</optgroup>\n";
                            }
                            echo $values;
                        }
                    @endphp">&nbsp;
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
