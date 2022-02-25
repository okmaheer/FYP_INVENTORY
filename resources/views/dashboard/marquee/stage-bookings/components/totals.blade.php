<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @if(isset($for))
                    <div class="row">
                        <div class="col-md-3">
                            {!!  Html::decode(Form::label('grand_total' ,'Total Bill' ,['class'=>'col-form-label text-right ml-1']))   !!}
                            <div class="input-group">
                                {!! Form::text('grand_total',$model->grand_total,['id'=>'grand_total','class'=>'form-control text-right','placeholder'=>'0.00','readonly','tabindex' => -1 ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            {!!  Html::decode(Form::label('misc_discount_total' ,'Global Discount' ,['class'=>'col-form-label text-right ml-1']))   !!}
                            <div class="input-group">
                                {!! Form::number('misc_discount_total',null,['id'=>'misc_discount_total','class'=>'form-control text-right','placeholder'=>'0.00','onkeyup'=>'applyCalculations();','onchange'=>'applyCalculations();','autocomplete'=>'off']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            {!!  Html::decode(Form::label('discount_total' ,'Total Discount' ,['class'=>'col-form-label text-right ml-1']))   !!}
                            <div class="input-group">
                                {!! Form::text('discount_total',$model->discount_total,['step'=>'any','min'=>'0','id'=>'discount_total','class'=>'form-control text-right','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            {!!  Html::decode(Form::label('net_total' ,'Net Total' ,['class'=>'col-form-label text-right ml-1']))   !!}
                            <div class="input-group">
                                {!! Form::text('net_total',$model->net_total,['id'=>'net_total','class'=>'form-control text-right','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            {!!  Html::decode(Form::label('total_paid_amount' ,'Paid Amount' ,['class'=>'col-form-label text-right ml-1']))   !!}
                            <div class="input-group">
                                {!! Form::text('total_paid_amount',$model->total_paid_amount,['step'=>'any','min'=>'0','id'=>'total_paid_amount','class'=>'form-control text-right','placeholder'=>'0.00','onkeyup'=>'applyCalculations();','onchange'=>"applyCalculations();",'autocomplete'=>'off']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            {!!  Html::decode(Form::label('paid_percentage' ,'Paid Percentage' ,['class'=>'col-form-label text-right ml-1']))   !!}
                            <div class="input-group">
                                {!! Form::text('paid_percentage','0.00',['id'=>'paid_percentage','class'=>'form-control text-right','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            {!!  Html::decode(Form::label('total_dues_amount' ,'Remaining Balance' ,['class'=>'col-form-label text-right ml-1']))   !!}
                            <div class="input-group">
                                {!! Form::text('total_dues_amount',$model->total_dues_amount,['id'=>'total_dues_amount','class'=>'form-control text-right','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-3">
                            {!!  Html::decode(Form::label('grand_total' ,'Total Bill' ,['class'=>'col-form-label text-right ml-1']))   !!}
                            <div class="input-group">
                                {!! Form::text('grand_total','0.00',['id'=>'grand_total','class'=>'form-control text-right','placeholder'=>'0.00','readonly','tabindex' => -1 ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            {!!  Html::decode(Form::label('misc_discount_total' ,'Global Discount' ,['class'=>'col-form-label text-right ml-1']))   !!}
                            <div class="input-group">
                                {!! Form::number('misc_discount_total',null,['step'=>'any','min'=>'0','id'=>'misc_discount_total','class'=>'form-control text-right','placeholder'=>'0.00','onkeyup'=>'applyCalculations();','onchange'=>"applyCalculations();",'autocomplete'=>'off']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            {!!  Html::decode(Form::label('discount_total' ,'Total Discount' ,['class'=>'col-form-label text-right ml-1']))   !!}
                            <div class="input-group">
                                {!! Form::text('discount_total','0.00',['id'=>'discount_total','class'=>'form-control text-right','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            {!!  Html::decode(Form::label('net_total' ,'Net Total' ,['class'=>'col-form-label text-right ml-1']))   !!}
                            <div class="input-group">
                                {!! Form::text('net_total','0.00',['id'=>'net_total','class'=>'form-control text-right','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            {!!  Html::decode(Form::label('total_paid_amount' ,'Paid Amount' ,['class'=>'col-form-label text-right ml-1']))   !!}
                            <div class="input-group">
                                {!! Form::text('total_paid_amount',null,['step'=>'any','min'=>'0','id'=>'total_paid_amount','class'=>'form-control text-right','placeholder'=>'0.00','onkeyup'=>'applyCalculations(this);','onchange'=>"applyCalculations();",'autocomplete'=>'off']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            {!!  Html::decode(Form::label('paid_percentage' ,'Paid Percentage' ,['class'=>'col-form-label text-right ml-1']))   !!}
                            <div class="input-group">
                                {!! Form::text('paid_percentage','0.00',['id'=>'paid_percentage','class'=>'form-control text-right','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            {!!  Html::decode(Form::label('total_dues_amount' ,'Remaining Balance' ,['class'=>'col-form-label text-right ml-1']))   !!}
                            <div class="input-group">
                                {!! Form::text('total_dues_amount','0.00',['id'=>'total_dues_amount','class'=>'form-control text-right','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
