{!! Form::open(['route' => 'dashboard.marquee.stage.booking.store', 'files' => true, 'id' => 'booking_form', 'class' => 'solid-validation'] ) !!}
{!! csrf_field() !!}
{!! Form::hidden('custom_stage_number',$stage_booking_no, ['id' => 'custom_stage_number']) !!}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="panel-title ">
                    <div class="row border-grey border-bottom">
                        <div class="col-lg-12">
                            <h3 class="p-3 text-dark text-center">Stage Booking Form</h3>
                        </div>
                    </div>
                </div>
                @include('dashboard.marquee.stage-bookings.components.general')
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-white bg-transparent py-0">
                <h4 class="mt-1 ml-2 header-title">
                    {!!  Html::decode(Form::label('stage_decoration' ,'Stage Decorations' ,['class'=>'col-form-label text-right']))   !!}
                </h4>
            </div>
            <div class="card-body">
                @include('dashboard.marquee.stage-bookings.components.stage-decorations')
            </div>
        </div>
    </div>
</div>
@include('dashboard.marquee.stage-bookings.components.totals')
<div class="row">
    <div class="col-12 text-right">
        <div class="card">
            <div class="card-body">
                @include('dashboard.accounts.common.buttons.buttons-crud', ['save' => true, 'save_print' => true, 'form_id' => 'booking_form',
                                   'reset' => true, 'cancel' => true, 'cancel_route' => 'dashboard.marquee.stage.booking.index'])
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
