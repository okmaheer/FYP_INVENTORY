@if(isset($for))
    <div class="row">
        <div class="col-md-3">
            {!!  Html::decode(Form::label('grand_total' ,'Total Bill' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!! Form::text('grand_total','0.00',['id'=>'grand_total','class'=>'form-control text-right','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('misc_discount_type' ,'Discount Type' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!!  Form::select('misc_discount_type', \MarqueeHelper::eventDiscount(), null,['id'=>'misc_discount_type',
                    'class'=>'select2 form-control mb-3 custom-select float-right', 'style'=>'width:100%',
                    'placeholder'=>'Select Type','onchange'=>'applyCalculations();'])
                !!}
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('misc_discount_total' ,'Discount' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!! Form::number('misc_discount_total',null,['id'=>'misc_discount_total','class'=>'form-control text-right','placeholder'=>'0.00','onkeyup'=>'applyCalculations();','onchange'=>"applyCalculations();",'autocomplete'=>'off']) !!}
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('misc_discount_value' ,'Discount Amount' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!! Form::number('misc_discount_value',null,['id'=>'misc_discount_value','class'=>'form-control text-right','placeholder'=>'0.00', 'readonly', 'tabindex'=>-1]) !!}
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4">
            {!!  Html::decode(Form::label('tax_id' ,'Tax' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!!  Form::select('tax_id', $taxes, null,['id'=>'tax_id',
                    'class'=>'select2 form-control mb-3 custom-select float-right', 'style'=>'width:100%',
                    'placeholder'=>'Select Tax','onchange'=>'getTaxValue(this);'])
                !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('total_tax' ,'Tax Amount' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!! Form::text('total_tax',null,['id'=>'total_tax','class'=>'form-control text-right','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('net_total' ,'Net Total' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!! Form::text('net_total','0.00',['id'=>'net_total','class'=>'form-control text-right','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            {!!  Html::decode(Form::label('total_paid_amount' ,'Paid/Advance Amount' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!! Form::number('total_paid_amount',isset($from) ? '' : null,['id'=>'total_paid_amount','class'=>'form-control text-right','placeholder'=>'0.00','onkeyup'=>'applyCalculations();','onchange'=>"applyCalculations();",'autocomplete'=>'off']) !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('paid_percentage' ,'Paid/Advance Percentage' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!! Form::text('paid_percentage','0.00',['id'=>'paid_percentage','class'=>'form-control text-right','placeholder'=>'0.00','readonly']) !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('total_dues_amount' ,'Remaining Balance' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!! Form::text('total_dues_amount',null,['id'=>'total_dues_amount','class'=>'form-control text-right','placeholder'=>'0.00','readonly']) !!}
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-md-3">
            {!!  Html::decode(Form::label('grand_total' ,'Total Bill' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!! Form::text('grand_total','0.00',['id'=>'grand_total','class'=>'form-control text-right','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('misc_discount_type' ,'Discount Type' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!!  Form::select('misc_discount_type', \MarqueeHelper::eventDiscount(), null,['id'=>'misc_discount_type',
                    'class'=>'select2 form-control mb-3 custom-select float-right', 'style'=>'width:100%',
                    'placeholder'=>'Select Type','onchange'=>'applyCalculations();'])
                !!}
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('misc_discount_total' ,'Discount' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!! Form::number('misc_discount_total',null,['id'=>'misc_discount_total','class'=>'form-control text-right','placeholder'=>'0.00','onkeyup'=>'applyCalculations();','onchange'=>"applyCalculations();",'autocomplete'=>'off']) !!}
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('misc_discount_value' ,'Discount Amount' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!! Form::number('misc_discount_value',null,['id'=>'misc_discount_value','class'=>'form-control text-right','placeholder'=>'0.00', 'readonly', 'tabindex'=>'-1']) !!}
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4">
            {!!  Html::decode(Form::label('tax_id' ,'Tax' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!!  Form::select('tax_id', $taxes, null,['id'=>'tax_id',
                    'class'=>'select2 form-control mb-3 custom-select float-right', 'style'=>'width:100%',
                    'placeholder'=>'Select Tax','onchange'=>'getTaxValue(this);'])
                !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('total_tax' ,'Tax Amount' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!! Form::text('total_tax','0.00',['id'=>'total_tax','class'=>'form-control text-right','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('net_total' ,'Net Total' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!! Form::text('net_total','0.00',['id'=>'net_total','class'=>'form-control text-right','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            {!!  Html::decode(Form::label('total_paid_amount' ,'Paid/Advance Amount' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!! Form::number('total_paid_amount',null,['id'=>'total_paid_amount','class'=>'form-control text-right','placeholder'=>'0.00','onkeyup'=>'applyCalculations();','onchange'=>"applyCalculations();",'autocomplete'=>'off']) !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('paid_percentage' ,'Paid/Advance Percentage' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!! Form::text('paid_percentage','0.00',['id'=>'paid_percentage','class'=>'form-control text-right','placeholder'=>'0.00','readonly', 'tabindex'=> -1]) !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('total_dues_amount' ,'Remaining Balance' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!! Form::text('total_dues_amount','0.00',['id'=>'total_dues_amount','class'=>'form-control text-right','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
            </div>
        </div>
    </div>
@endif
