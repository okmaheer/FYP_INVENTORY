<div class="row">
    <div class="col-md-3">
        {!!  Html::decode(Form::label('number_person' ,'Number Persons' ,['class'=>'col-form-label text-left']))   !!}
        {!!  Form::number('number_person',null,['id'=>'number_person','class'=>'form-control ','placeholder'=>'counter lugna idr']) !!}
    </div>
    <div class="col-md-3">
        {!!  Html::decode(Form::label('customer_id' ,'Rate/Head' ,['class'=>'col-form-label text-left']))   !!}
        {!!  Form::select('item_type', AccountHelper::Booking(),null,['id'=>'item_type',
                'class'=>'select2 form-control mb-3 custom-select float-right',
                'placeholder'=>'Select Rate/Head'])
                    !!}
    </div>
    <div class="col-md-3">
        {!!  Html::decode(Form::label('partition' ,'Partition Required' ,['class'=>'col-form-label text-left']))   !!}
        {!!  Form::select('partition', AccountHelper::partitionRequire(),null,['id'=>'partition',
                    'class'=>'select2 form-control mb-3 custom-select float-right',
                    'placeholder'=>'Select Event Area'])
                        !!}
    </div>
    <div class="col-md-3">
        {!!  Html::decode(Form::label('customer_id' ,'Colour Scheme' ,['class'=>'col-form-label text-left']))   !!}
        {!!  Form::select('item_type', AccountHelper::colourScheme(),null,['id'=>'item_type',
        'class'=>'select2 form-control mb-3 custom-select float-right',
        'placeholder'=>'Select Event Area'])
         !!}
    </div>
</div>
