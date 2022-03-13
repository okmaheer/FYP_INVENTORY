@if(isset($for))
<div class="row">
    <div class="col-md-4">
        {!!  Html::decode(Form::label('grand_total_amount' ,'Total Bill' ,['class'=>'col-form-label']))   !!}
        <div class="input-group">
            {!!  Form::text('grand_total_amount', $model->grand_total_amount,['id'=>'grand_total_amount','class'=>'form-control text-right','placeholder'=>'0.00','readonly', 'tabindex' => '-1']) !!}
        </div>
    </div>
    <div class="col-md-4">
        {!!  Html::decode(Form::label('total_discount' ,'Misc. Discount' ,['class'=>'col-form-label']))   !!}
        <div class="input-group">
            {!!  Form::number('total_discount',$model->total_discount,['step'=>'any','min'=>'0','id'=>'total_discount','class'=>'form-control text-right','placeholder'=>'0.00','onkeyup'=>'applyCalculations();','onchange'=>'applyCalculations();', 'autocomplete'=>'off']) !!}
        </div>
    </div>
    <div class="col-md-4">
        {!!  Html::decode(Form::label('net_total_amount' ,'Net Total' ,['class'=>'col-form-label']))   !!}
        <div class="input-group">
        {!!  Form::text('net_total_amount',$model->net_total_amount,['id'=>'net_total_amount','class'=>'form-control text-right','placeholder'=>'0.00','readonly', 'tabindex' => '-1']) !!}
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        {!!  Html::decode(Form::label('paid_amount' ,'Paid Amount' ,['class'=>'col-form-label']))   !!}
        <div class="input-group">
            {!!  Form::number('paid_amount',$model->paid_amount,['step'=>'any','min'=>'0','id'=>'paid_amount','class'=>'form-control text-right','placeholder'=>'0.00','onkeyup'=>'applyCalculations();','onchange'=>'applyCalculations();', 'autocomplete'=>'off']) !!}
        </div>
    </div>
    <div class="col-md-4">
        {!!  Html::decode(Form::label('paid_percentage' ,'Paid Percentage' ,['class'=>'col-form-label text-right ml-1']))   !!}
        <div class="input-group">
            {!!  Form::text('paid_percentage',null,['id'=>'paid_percentage','class'=>'form-control text-right','placeholder'=>'0.00','readonly', 'tabindex' => '-1']) !!}
        </div>
    </div>
    <div class="col-md-4">
        {!!  Html::decode(Form::label('due_amount' ,'Remaining Balance' ,['class'=>'col-form-label']))   !!}
        <div class="input-group">
            {!!  Form::text('due_amount',$model->due_amount,['id'=>'due_amount','class'=>'form-control text-right','placeholder'=>'0.00','readonly', 'tabindex' => '-1']) !!}
        </div>
    </div>
</div>
@else
    <div class="row">
        <div class="col-md-4">
            {!!  Html::decode(Form::label('grand_total_amount' ,'Total Bill' ,['class'=>'col-form-label']))   !!}
            <div class="input-group">
                {!!  Form::text('grand_total_amount',null,['id'=>'grand_total_amount','class'=>'form-control text-right','placeholder'=>'0.00','readonly', 'tabindex' => '-1']) !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('total_discount' ,'Misc. Discount' ,['class'=>'col-form-label']))   !!}
            <div class="input-group">
                {!!  Form::number('total_discount',null,['step'=>'any','min'=>'0','id'=>'total_discount','class'=>'form-control text-right','placeholder'=>'0.00','onkeyup'=>'applyCalculations();','onchange'=>'applyCalculations();', 'autocomplete'=>'off']) !!}
            </div>
        </div>

        <div class="col-md-4">
            {!!  Html::decode(Form::label('net_total_amount' ,'Net Total' ,['class'=>'col-form-label']))   !!}
            <div class="input-group">
            {!!  Form::text('net_total_amount',null,['id'=>'net_total_amount','class'=>'form-control text-right','placeholder'=>'0.00','readonly', 'tabindex' => '-1']) !!}
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            {!!  Html::decode(Form::label('paid_amount' ,'Paid Amount' ,['class'=>'col-form-label']))   !!}
            <div class="input-group">
                {!!  Form::number('paid_amount',null,['step'=>'any','min'=>'0','id'=>'paid_amount','class'=>'form-control text-right','placeholder'=>'0.00','onkeyup'=>'applyCalculations();','onchange'=>'applyCalculations();', 'autocomplete'=>'off']) !!}
            </div>
        </div>
        <div class="col-md-4">
            {!!  Html::decode(Form::label('paid_percentage' ,'Paid Percentage' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!!  Form::text('paid_percentage',null,['id'=>'paid_percentage','class'=>'form-control text-right','placeholder'=>'0.00','readonly', 'tabindex' => '-1']) !!}
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
