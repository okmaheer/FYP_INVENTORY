@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
<link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css"/>

@endsection
@include('includes.dashboard-breadcrumbs')
<style>
    /* .col-sm-1{
      margin-left: -115px;
  } */

</style>
@section('body')
    <div class="page-content">
        <div class="container-fluid">
            {!! Form::open([ 'route' => 'dashboard.marquee.demand.store','files' => true] ) !!}
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-12">


                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-2 pull-left mb-2">
                                    <a href="{{route('dashboard.marquee.demand.index')}}" class="btn btn-danger text-light">Back</a>
                                </div>
                                <div class="col-md-6 text-center mb-4">
                                    <h2>Order Details</h2>
                                </div>
                            </div>

                            <div class="card">

                                <div class="card-body">
                                    @include('dashboard.marquee.stage-bookings.components.general')
{{--                                    demand type--}}
                                    {!!  Html::decode(Form::label('demand_type' ,'Demand Type' ,['class'=>'col-sm-3 col-form-label text-left']))   !!}
                                    <div class="input-group">
                                        {!!  Form::select('demand_type', MarqueeHelper::demand(),null,['id'=>'demand_type','class'=>'select2 form-control mb-3 custom-select float-right','placeholder'=>'Select Demand Type'])
                                             !!}

                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                    <!--end card-->
                    @include('dashboard.marquee.demand.comp.add_demand')


                </div>
                <!-- end col -->
            </div>

            {!! Form::submit('Submit', array('class' => 'btn btn-success ')) !!}
            {!! Form::close() !!}
        </div><!-- container -->

        @include('includes.dashboard-footer')
    </div>

@endsection
@endsection


@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
@endsection
@section('innerScript')
    <script>
        (function () {
            $('select').select2();
        })();

        function getMenuFoodItems(cElement) {
            let id = $(cElement).find('option:selected').val();
            $.ajax({
                type: 'GET',
                url: "/api/marquee/food_items_by_menu_id/" + id,
                success: function (response) {
                    if (response.status === true) {
                        $("#food_items_body").empty().append(response.data);
                        applyCalculations();
                    } else {
                        alert("No Menu Found with this Id")
                    }
                }
            });
        }

        function cloneRow(cElement) {
            let clone = $(cElement).closest('tr').clone();
            $(clone).find('input[type=text]').val('');
            $(clone).find('input[type=number]').val(0);
            $(clone).find('input[type=hidden]').val('');
            $(cElement).closest('tbody').append(clone);

        }

        function removeClonedRow(cElement) {
            let length = $(cElement).closest('tbody').find('tr').length;
            if (length > 1) {
                $(cElement).closest('tr').remove();
            } else {
                alert("At least one row is Required")
            }

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
                        url: "/autocomplete/demand?d=" + $(cElement).val(),
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

                    $(this).unbind("change");
                    return false;
                }
            };
            $('body').on('keypress.autocomplete', '.current_product', function () {
                $(this).autocomplete(options);
            });
        }
        function searchBooking(){
            var booking_no = $('#booking_no').val();
            if ( booking_no == 0) {
                alert('Please select Booking No !');
                return false;
            }
            // console.log('booking number is :'+ booking_no);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'GET',
                url: "/autocomplete/booking?d=" + booking_no,
                success: function (data) {
                    if($.trim(data)){
                        document.getElementById('phone_number').value = data['data'].phone_number;
                        document.getElementById('sec_contact_no').value = data['data'].sec_contact_no;
                        document.getElementById('national_id_card').value = data['data'].national_id_card;
                        // document.getElementById('event_area').value = data['data'].event_area;
                        document.getElementById('address').value = data['data'].address;
                        document.getElementById('event_date').value = data['data'].event_date;
                        document.getElementById('event_time').value = data['data'].event_time;
                        document.getElementById('booking_detail').value = data['data'].booking_detail;
                        document.getElementById('customer_id').value = data['data'].customer_option;
                        document.getElementById('customer_option').value = data.customer;
                        console.log(data);
                    }

                }
            });

        }


    </script>
@endsection
