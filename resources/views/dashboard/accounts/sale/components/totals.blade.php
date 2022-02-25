@if(isset($for))
    <div class="row">
        <div class="col-md-4">
            {!!  Html::decode(Form::label('grand_total_price' ,'Total Bill' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::text('grand_total_price',null,['id'=>'grand_total_price','class'=>'form-control text-right','placeholder'=>'0.00','readonly', 'tabindex' => '-1']) !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('invoice_discount' ,'Misc. Discount' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::number('invoice_discount',null,['step'=>'any','min'=>'0', 'id'=>'invoice_discount','class'=>'form-control text-right','placeholder'=>'0.00','onkeyup'=>'applyCalculations();','onchange'=>'applyCalculations();', 'autocomplete'=>'off']) !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('total_discount' ,'Total Discount' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::text('total_discount',null,['id'=>'total_discount','class'=>'form-control text-right','placeholder'=>'0.00','readonly', 'tabindex' => '-1']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            {!!  Html::decode(Form::label('shipping_cost' ,'Freight Charges' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::number('shipping_cost',null,['step'=>'any','min'=>'0', 'id'=>'shipping_cost','class'=>'form-control text-right','placeholder'=>'0.00','onkeyup'=>'applyCalculations();','onchange'=>'applyCalculations();', 'autocomplete'=>'off']) !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('tax_id' ,'Tax' ,['class'=>'col-form-label']))   !!}
            <div class="input-group">
                {!!  Form::select('tax_id', $tax, null,['id'=>'tax_id',
                    'class'=>'select2 form-control',
                    'style' => 'width:100%', 'onchange'=>'getTaxValue(this.value);',
                    'placeholder'=>'Select Tax'])
                !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('total_tax' ,'Total Tax' ,['class'=>'col-form-label']))   !!}
            <div class="input-group">
                {!!  Form::text('total_tax',null,['id'=>'total_tax','class'=>'form-control text-right','placeholder'=>'0.00','readonly', 'tabindex' => '-1']) !!}
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            {!!  Html::decode(Form::label('net_total' ,'Net Total' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::text('net_total',null,['id'=>'net_total','class'=>'form-control text-right','placeholder'=>'0.00','readonly', 'tabindex' => '-1']) !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('paid_amount' ,'Paid Amount' ,['class'=>'col-form-label']))   !!}
            <div class="input-group">
                {!!  Form::number('paid_amount',null,['step'=>'any','min'=>'0', 'id'=>'paid_amount','class'=>'form-control text-right','placeholder'=>'0.00','onkeyup'=>'applyCalculations();','onchange'=>'applyCalculations();', 'autocomplete'=>'off']) !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('due_amount' ,'Remaining Balance' ,['class'=>'col-form-label']))   !!}
            <div class="input-group">
                {!!  Form::text('due_amount',null,['id'=>'due_amount','class'=>'form-control text-right','placeholder'=>'0.00','readonly', 'tabindex' => '-1']) !!}
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-md-4">
            {!!  Html::decode(Form::label('grand_total_price' ,'Total Bill' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::text('grand_total_price',null,['id'=>'grand_total_price','class'=>'form-control text-right','placeholder'=>'0.00','readonly', 'tabindex' => '-1']) !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('invoice_discount' ,'Misc. Discount' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::number('invoice_discount',null,['step'=>'any','min'=>'0', 'id'=>'invoice_discount','class'=>'form-control text-right','onkeyup'=>'applyCalculations();','onchange'=>'applyCalculations();', 'autocomplete'=>'off']) !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('total_discount' ,'Total Discount' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::text('total_discount',null,['id'=>'total_discount','class'=>'form-control text-right','placeholder'=>'0.00','readonly', 'tabindex' => '-1']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            {!!  Html::decode(Form::label('shipping_cost' ,'Freight Charges' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::number('shipping_cost',null,['step'=>'any','min'=>'0', 'id'=>'shipping_cost','class'=>'form-control text-right','placeholder'=>'0.00','onkeyup'=>'applyCalculations();','onchange'=>'applyCalculations();', 'autocomplete'=>'off']) !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('tax_id' ,'Tax' ,['class'=>'col-form-label']))   !!}
            <div class="input-group">
                {!!  Form::select('tax_id', $tax,null,['id'=>'tax_id',
                'class'=>'select2 form-control mb-3 custom-select float-right',
                'style' => 'width:100%', 'onchange'=>'getTaxValue(this.value);',
                'placeholder'=>'Select Tax'])
            !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('total_tax' ,'Total Tax' ,['class'=>'col-form-label']))   !!}
            <div class="input-group">
                {!!  Form::text('total_tax',null,['id'=>'total_tax','class'=>'form-control text-right','placeholder'=>'0.00','readonly', 'tabindex' => '-1']) !!}
            </div>
        </div>
    </div>
    <div class="row mb-3">

        <div class="col-md-4">
            {!!  Html::decode(Form::label('net_total' ,'Net Total' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::text('net_total',null,['id'=>'net_total','class'=>'form-control text-right','placeholder'=>'0.00','readonly', 'tabindex' => '-1']) !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('paid_amount' ,'Paid Amount' ,['class'=>'col-form-label']))   !!}
            <div class="input-group">
                {!!  Form::number('paid_amount',null,['step'=>'any','min'=>'0', 'id'=>'paid_amount','class'=>'form-control text-right','placeholder'=>'0.00','onkeyup'=>'applyCalculations();','onchange'=>'applyCalculations();', 'autocomplete'=>'off']) !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('due_amount' ,'Remaining Balance' ,['class'=>'col-form-label']))   !!}
            <div class="input-group">
                {!!  Form::text('due_amount',null,['id'=>'due_amount','class'=>'form-control text-right','placeholder'=>'0.00','readonly', 'tabindex' => '-1']) !!}
            </div>
        </div>
    </div>
@endif
