@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@include('includes.dashboard-breadcrumbs')
@section('body')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(['route' => 'dashboard.marquee.gatepass.store', 'files' => true] ) !!}
                            {!! csrf_field() !!}
                            @include('dashboard.marquee.gate-pass.components.create_general')
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-white bg-transparent py-0">
                            <h4 class="mt-1 ml-2 header-title">
                                {!!  Html::decode(Form::label('food_items' ,'Select Food Menu/Items' ,['class'=>'col-form-label text-right']))   !!}
                            </h4>
                        </div>
                        <div class="card-body">
                            @include('dashboard.marquee.gate-pass.components.food-menu-items')
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-white bg-transparent py-0">
                            <h4 class="mt-1 ml-2 header-title">
                                {!!  Html::decode(Form::label('add_on_features' ,'Hardware/ Items / Addons ' ,['class'=>'col-form-label text-right']))   !!}
                            </h4>
                        </div>
                        <div class="card-body">
                            @include('dashboard.marquee.gate-pass.components.add-on-features')

                            <div class="text-right">
                                {!! Form::submit('Submit', array('class' => 'btn btn-success ')) !!}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@endsection

@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/admin_js/invoice.js') }}"></script>
@endsection

@section('innerScript')
    <script type="text/javascript">
        var base_url = '{{ url('/')}}';
    </script>
    <script>
        (function () {
            $('select').select2();
        })();

        function cloneRow(cElement) {
            let clone = $(cElement).closest('tr').clone();
            $(clone).find('input[type=text]').val('');
            $(clone).find('input[type=number]').val(0);
            $(clone).find('input[type=hidden]').val('');
            $(cElement).closest('tbody').append(clone);
            applyCalculations();
        }

        function removeClonedRow(cElement) {
            let length = $(cElement).closest('tbody').find('tr').length;
            if (length > 1) {
                $(cElement).closest('tr').remove();
            } else {
                alert("At least one row is Required")
            }
            applyCalculations();
        }


        function applySearchingForAddOn(cElement) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var options = {
                source: function (request, response) {
                    $.ajax({
                        type: 'GET',
                        url: "/autocomplete/hardware-items?d=" + $(cElement).val(),
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                focus: function (event, ui) {
                    $(this).val(ui.item.label);
                    return false;
                },
                select: function (event, ui) {
                    $(this).val(ui.item.label);
                    $(cElement).closest('tr').find('.current_price').val(ui.item.extra.price);
                    $(cElement).closest('tr').find('.current_id').val(ui.item.value);
                    applyCalculations();
                    $(this).unbind("change");
                    return false;
                }
            };
            $('body').on('keypress.autocomplete', '.add_on_feature_name', function () {
                $(this).autocomplete(options);
            });
        }

        function applySearchingForSeatPlannings(cElement) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var options = {
                source: function (request, response) {
                    $.ajax({
                        type: 'GET',
                        url: "/autocomplete/seat-plannings?d=" + $(cElement).val(),
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                focus: function (event, ui) {
                    $(this).val(ui.item.label);
                    return false;
                },
                select: function (event, ui) {
                    $(this).val(ui.item.label);
                    $(cElement).closest('tr').find('.current_id').val(ui.item.value);
                    $(cElement).closest('tr').find('.current_price').val(ui.item.extra.price);
                    applyCalculations();
                    $(this).unbind("change");
                    return false;
                }
            };
            $('body').on('keypress.autocomplete', '.seat_planning_name', function () {
                $(this).autocomplete(options);
            });
        }

        function applySearchingForStageDecorations(cElement) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var options = {
                source: function (request, response) {
                    $.ajax({
                        type: 'GET',
                        url: "/autocomplete/stage-decorations?d=" + $(cElement).val(),
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                focus: function (event, ui) {
                    $(this).val(ui.item.label);
                    return false;
                },
                select: function (event, ui) {
                    $(this).val(ui.item.label);
                    $(cElement).closest('tr').find('.current_id').val(ui.item.value);
                    $(cElement).closest('tr').find('.current_price').val(ui.item.extra.price);
                    applyCalculations();
                    $(this).unbind("change");
                    return false;
                }
            };
            $('body').on('keypress.autocomplete', '.stage_decoration_name', function () {
                $(this).autocomplete(options);
            });
        }

        function applySearchingOnMenu(cElement) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var options = {
                source: function (request, response) {
                    $.ajax({
                        type: 'GET',
                        url: "/autocomplete/menus?d=" + $(cElement).val(),
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                focus: function (event, ui) {
                    $(this).val(ui.item.label);
                    return false;
                },
                select: function (event, ui) {
                    $(this).val(ui.item.label);
                    $(cElement).closest('tr').find('.current_id').val(ui.item.value);
                    $(cElement).closest('tr').find('.current_price').val(ui.item.extra.price);
                    applyCalculations();
                    $(this).unbind("change");
                    return false;
                }
            };
            $('body').on('keypress.autocomplete', '.current_product', function () {
                $(this).autocomplete(options);
            });
        }

        function applyPrice(cElement) {

            let price = $(cElement).val();
            let discount = $(cElement).closest('tr').find('.current_discount').val();
            let quantity = $(cElement).closest('tr').find('.current_quantity').val();

            let final_price = quantity * price;
            let find_discount = +(final_price * discount / 100);
            let current_total = final_price - find_discount;
            $(cElement).closest('tr').find('.current_total').val(current_total);

            applyCalculations();
        }

        function applyDiscount(cElement) {

            let discount = $(cElement).val();
            let price = $(cElement).closest('tr').find('.current_price').val();
            let quantity = $(cElement).closest('tr').find('.current_quantity').val();

            let final_price = quantity * price;
            let find_discount = +(final_price * discount / 100);
            let current_total = final_price - find_discount;
            $(cElement).closest('tr').find('.current_total').val(current_total);

            applyCalculations();
        }

        function applyQuantity(cElement) {

            let quantity = $(cElement).val();
            let price = $(cElement).closest('tr').find('.current_price').val();
            let discount = $(cElement).closest('tr').find('.current_discount').val();

            let final_price = quantity * price;
            let find_discount = +(final_price * discount / 100);
            let current_total = final_price - find_discount;

            $(cElement).closest('tr').find('.current_total').val(current_total);

            applyCalculations();
        }

        function applyCalculations() {
            // Discount Management
            let totalDiscount = 0;
            $('.current_discount').each(function () {
                let innerDiscount = parseFloat($(this).val());
                totalDiscount += innerDiscount;
            });
            $("#discount_total").val(!isNaN(totalDiscount) ? totalDiscount : '0');


            // Grand Management

            let grandTotal = 0;
            $('.current_price').each(function () {
                let innerQuantity = $(this).closest('tr').find('.current_quantity').val();
                let innerPriceTotal = parseFloat($(this).val()) * parseInt(innerQuantity);
                grandTotal += innerPriceTotal;
            });
            $("#grand_total").val(grandTotal);

            //Net Total

            let netTotal = 0;
            $('.current_total').each(function () {
                let innerNetTotal = parseFloat($(this).val());
                netTotal += innerNetTotal;
            });
            $("#net_total").val(netTotal);
        }
    </script>
@endsection

