@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('content')
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@include('includes.dashboard-breadcrumbs')
@section('body')
    <div class="page-content">
        <div class="container-fluid">
            {!! Form::open(['route' => 'dashboard.marquee.recipe.store', 'files' => true, 'id' => 'recipe_form', 'class' => 'solid-validation'] ) !!}
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-12">

                    <div class="card">
                    @include('includes.messages')  <!--ALert Message--->
                        <div class="card-header bg-white bg-transparent py-0">
                            <h3 class="text-center">
                                Add Ingredients
                            </h3>
                        </div>
                         <div class="card-body">
                            <div class="row justify-content-center form-group">

                                    <div class="col-md-10">
                                    {!!  Html::decode(Form::label('recipe_name' ,'Recipe Name <i class="text-danger">*</i>' ,['class'=>'']))   !!}
                                </div>
                              <div class="col-md-10">
                                {!!  Form::hidden('recipe_product_id',null,['class'=>'current_id']) !!}
                                {!!  Form::text('recipe_name',null,['id'=>'recipeName','class'=>'form-control current_product current_menu_product ','placeholder'=>'Recipe Name','onkeypress'=>'applySearchingOnRecipeHead(this);', 'required', 'autocomplete'=>'off']) !!}
                                </div>
                        <div class="mt-3 col-md-12">
                                @include('dashboard.marquee.recipe.component.ingredient')
                            </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-12 text-right">
                  <div class="card">
                      <div class="card-body">
                          @include('dashboard.accounts.common.buttons.buttons-crud', ['save' => true, 'save_new' => true, 'reset' => 'true',
                            'form_id' => 'recipe_form', 'cancel' => true, 'cancel_route' => 'dashboard.marquee.recipe.index'])
                      </div>
                  </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@endsection
@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
@endsection
@section('innerScript')
<script>

    function applySearchingOnRecipeHead(cElement) {
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
                $(cElement).closest('div').find('.current_id').val(ui.item.value);
                // $(cElement).closest('tr').find('.current_price').val(ui.item.extra.price);
                $(this).unbind("change");
                return false;
            }
        };
        $('body').on('keypress.autocomplete', '.current_product', function () {
            $(this).autocomplete(options);
        });
    }
    function applySearchingOnIngredients(cElement) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        var options = {
            source: function (request, response) {
                $.ajax({
                    type: 'GET',
                    url: "/autocomplete/ingredients?d=" + $(cElement).val(),
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
                $(cElement).closest('tr').find('.current_unit').val(ui.item.extra.unit);
                $(this).unbind("change");
                return false;
            }
        };
        $('body').on('keypress.autocomplete', '.current_product', function () {
            $(this).autocomplete(options);
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
    function applyQuantity(cElement) {

        let quantity = $(cElement).closest('tr').find('.current_quantity').val();
        let price = $(cElement).closest('tr').find('.current_price').val();
        let final_price = quantity * price;

        $(cElement).closest('tr').find('.current_total').val(final_price);

        applyCalculations();
    }
    function applyCalculations(){
        let grandTotal = 0;
        $('.current_price').each(function () {
            let innerQuantity = $(this).closest('tr').find('.current_quantity').val();
            let innerPriceTotal = parseFloat($(this).val()) * parseInt(innerQuantity);
            grandTotal += innerPriceTotal;
        });
        $("#cost").val(grandTotal);
    }
</script>
<script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>

@endsection

