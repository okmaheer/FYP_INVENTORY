<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center product_field">Information</th>
            <th class="text-center">Stock/Qty</th>
            <th class="text-center">Price</th>
            <th class="text-center">Net Total</th>
            <th class="text-center">Discount</th>
            <th class="text-center">Total</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody id="food_items_body">
    @if(isset($for))
        @if(count($model->stageDecorations)>0)
            @foreach($model->stageDecorations as $stageDecoration)
                <tr>
                    <td>
                        {!! Form::hidden('stageDecorations[id][]',$stageDecoration->id,['class'=>'current_id']) !!}
                        {!! Form::text('stageDecorations[name][]',$stageDecoration->name,['class'=>'form-control current_product stage_decoration_name foredit1','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingForStageDecorations(this);', 'autocomplete'=>'off']) !!}
                    </td>
                    <td>
                        {!!  Form::number('stageDecorations[quantity][]',$stageDecoration->pivot->quantity,['id'=>'stageDecorations[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'0','onkeyup'=>'applyQuantity(this);','onchange'=>'applyQuantity(this);']) !!}
                    </td>
                    <td>
                        {!!  Form::number('stageDecorations[price][]',$stageDecoration->pivot->price,['id'=>'stageDecorations[price][]','class'=>'form-control  current_price','placeholder'=>'0.00','onkeyup'=>'applyPrice(this);','onchange'=>'applyPrice(this);']) !!}
                    </td>
                    <td>
                        {!!  Form::text('stageDecorations[net_total][]',$stageDecoration->pivot->net_total,['id'=>'stageDecorations[net_total][]','class'=>'form-control text-right current_net_total','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
                    </td>
                    <td>
                        {!!  Form::number('stageDecorations[discount][]',$stageDecoration->pivot->discount,['id'=>'stageDecorations[discount][]','class'=>'form-control  current_discount','placeholder'=>'0.00','onkeyup'=>'applyDiscount(this);','onchange'=>'applyDiscount(this);']) !!}
                    </td>
                    <td>
                        {!!  Form::text('stageDecorations[total][]',$stageDecoration->pivot->total,['id'=>'stageDecorations[total][]','class'=>'form-control text-right current_total','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
                    </td>
                    <td>
                        <a href="javascript:void(0);"
                           onclick="removeClonedRow(this);"
                           class="btn btn-xs btn-danger">
                            <i class="fas fa-times-circle"></i>
                        </a>
                        <a href="javascript:void(0);"
                           onclick="cloneRow(this);"
                           class="btn btn-xs btn-info">
                            <i class="fas fa-plus-circle"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td>
                    {!! Form::hidden('stageDecorations[id][]',null,['class'=>'current_id']) !!}
                    {!! Form::text('stageDecorations[name][]',null,['class'=>'form-control current_product stage_decoration_name','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingForStageDecorations(this);', 'autocomplete'=>'off']) !!}
                </td>
                <td>
                    {!!  Form::number('stageDecorations[quantity][]',null,['id'=>'stageDecorations[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'0','onkeyup'=>'applyQuantity(this);','onchange'=>'applyQuantity(this);']) !!}
                </td>
                <td>
                    {!!  Form::number('stageDecorations[price][]',null,['id'=>'stageDecorations[price][]','class'=>'form-control  current_price','placeholder'=>'0.00','onkeyup'=>'applyPrice(this);','onchange'=>'applyPrice(this);']) !!}
                </td>
                <td>
                    {!!  Form::text('stageDecorations[net_total][]',null,['id'=>'stageDecorations[net_total][]','class'=>'form-control text-right current_net_total','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
                </td>
                <td>
                    {!!  Form::number('stageDecorations[discount][]',null,['id'=>'stageDecorations[discount][]','class'=>'form-control  current_discount','placeholder'=>'0.00','onkeyup'=>'applyDiscount(this);','onchange'=>'applyDiscount(this);']) !!}
                </td>
                <td>
                    {!!  Form::text('stageDecorations[total][]',null,['id'=>'stageDecorations[total][]','class'=>'form-control text-right current_total','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
                </td>
                <td>
                    <a href="javascript:void(0);"
                       onclick="removeClonedRow(this);"
                       class="btn btn-xs btn-danger">
                        <i class="fas fa-times-circle"></i>
                    </a>
                    <a href="javascript:void(0);"
                       onclick="cloneRow(this);"
                       class="btn btn-xs btn-info">
                        <i class="fas fa-plus-circle"></i>
                    </a>
                </td>
            </tr>
        @endif
    @else
        <tr>
            <td>
                {!! Form::hidden('stageDecorations[id][]',null,['class'=>'current_id']) !!}
                {!! Form::text('stageDecorations[name][]',null,['id'=>'stageDecorations[name][]','class'=>'form-control current_product stage_decoration_name','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingForStageDecorations(this);', 'autocomplete'=>'off']) !!}
            </td>
            <td>
                {!!  Form::number('stageDecorations[quantity][]',null,['id'=>'stageDecorations[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'0','onkeyup'=>'applyQuantity(this);','onchange'=>'applyQuantity(this);']) !!}
            </td>
            <td>
                {!!  Form::number('stageDecorations[price][]',null,['id'=>'stageDecorations[price][]','class'=>'form-control  current_price','placeholder'=>'0.00','onkeyup'=>'applyPrice(this);','onchange'=>'applyPrice(this);']) !!}
            </td>
            <td>
                {!!  Form::text('stageDecorations[net_total][]',null,['id'=>'stageDecorations[net_total][]','class'=>'form-control text-right current_net_total','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
            </td>
            <td>
                {!!  Form::number('stageDecorations[discount][]',null,['id'=>'stageDecorations[discount][]','class'=>'form-control  current_discount','placeholder'=>'0.00','onkeyup'=>'applyDiscount(this);','onchange'=>'applyDiscount(this);']) !!}
            </td>
            <td>
                {!!  Form::text('stageDecorations[total][]',null,['id'=>'stageDecorations[total][]','class'=>'form-control text-right current_total','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
            </td>
            <td>
                <a href="javascript:void(0);"
                   onclick="removeClonedRow(this);"
                   class="btn btn-xs btn-danger">
                    <i class="fas fa-times-circle"></i>
                </a>
                <a href="javascript:void(0);"
                   onclick="cloneRow(this);"
                   class="btn btn-xs btn-info">
                    <i class="fas fa-plus-circle"></i>
                </a>
            </td>
        </tr>
    @endif
    </tbody>
</table>
