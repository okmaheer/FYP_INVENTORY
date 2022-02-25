@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
<style>
    th {
    color: white !important;
    }
</style>
@include('includes.dashboard-breadcrumbs')
@section('body')
    <div class="page-content">
        <div class="container-fluid">
            {!! Form::model($model, ['route' => ['dashboard.marquee.recipe.update', $model->id], 'method' => 'PUT', 'files' => true] ) !!}
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header bg-white bg-transparent py-0">
                            <h4 class="mt-1 ml-2 header-title">
                                {!!  Html::decode(Form::label('food_items' ,'Add Ingredients' ,['class'=>'col-form-label text-right ml-5 current_product current_menu_product']))   !!}
                            </h4>
                        </div>
                         <div class="card-body">
                            <div class="row justify-content-center form-group">
                                <div class="col-md-12">

                                    {!! Form::submit('Add production step ', array('class' => 'btn btn-success float-right')) !!}

                                    </div>
                                    <div class="col-md-10">
                                    {!!  Html::decode(Form::label('food_items' ,'Add Ingredients' ,['class'=>'']))   !!}
                                </div>
                              <div class="col-md-10">

                                {!!  Form::text('foodItems[name][]',null,['id'=>'foodItems[name][]','class'=>'form-control current_product current_menu_product ','placeholder'=>'Select Ingredients','onkeypress'=>'applySearchingOnMenu(this);']) !!}
                                </div>
                        <div class="mt-3 col-md-12">
                                @include('dashboard.marquee.recipe.component.ingredients')
                            </div>

                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                   <p class="float-right">Ingredients Cost: <span><b>5107<b></span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    {!!  Html::decode(Form::label('wastage' ,'Wastage: ' ,['class'=>'col-form-label text-left']))   !!}
                                    <div class="input-group ">
                                        {!!  Form::text('wastage',null,['id'=>'wastage','class'=>'form-control ','placeholder'=>'']) !!}
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {!!  Html::decode(Form::label('customer_id' ,'Total Output Quantity:' ,['class'=>'col-form-label text-left']))   !!}
                                    {!!  Form::text('sec_contact_no',null,['id'=>'sec_contact_no','class'=>'form-control ','placeholder'=>'23.385','readonly']) !!}

                                </div>
                                <div class="col-md-2">
                                    {!!  Html::decode(Form::label('partition' ,'Production Cost' ,['class'=>'col-form-label text-left']))   !!}
                                    {!!  Form::text('sec_contact_no',null,['id'=>'sec_contact_no','class'=>'form-control ','placeholder'=>'']) !!}
                                </div>
                                <div class="col-md-1">
                                    {!!  Html::decode(Form::label('partition' ,'Unit' ,['class'=>'col-form-label text-left']))   !!}
                                    {!!  Form::select('item_type', AccountHelper::Booking(),null,['id'=>'item_type',
                                    'class'=>'select2 form-control mb-3 custom-select float-right',
                                    'placeholder'=>'Percentage'])
                                        !!}

                                </div>
                                <div class="col-md-3">
                                    {!!  Html::decode(Form::label('partition' ,'Total ' ,['class'=>'col-form-label text-left']))   !!}
                                    <div class="input-group ">
                                        {!!  Form::text('total',null,['id'=>'total_cost','class'=>'form-control ','placeholder'=>'','readonly' ,'value' => '32,56']) !!}
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                    </div>

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
                          {!! Form::submit('Submit', array('class' => 'btn btn-success ')) !!}
                      </div>
                  </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@endsection
@include('dashboard.marquee.bookings.common-script')

