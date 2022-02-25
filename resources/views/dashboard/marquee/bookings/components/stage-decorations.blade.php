<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th class="text-center product_field">Information
        </th>
        <th class="text-center">Stock/Qty
        </th>
        <th class="text-center">Discount
        </th>
        <th class="text-center">Price
        </th>
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
                        {!! Form::text('stageDecorations[name][]',$stageDecoration->name,['id'=>'stageDecorations[name][]','class'=>'form-control current_product stage_decoration_name','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingForStageDecorations(this);', 'autocomplete'=>'off']) !!}
                    </td>
                    <td>
                        {!!  Form::number('stageDecorations[quantity][]',$stageDecoration->pivot->quantity,['min'=>'0','id'=>'stageDecorations[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','onchange'=>"applyQuantity(this);"]) !!}
                    </td>

                    <td>
                        {!!  Form::number('stageDecorations[price][]',$stageDecoration->pivot->price,['min'=>'0','id'=>'oodItems[price][]','class'=>'form-control  current_price','placeholder'=>'','onkeyup'=>'applyPrice(this);','onchange'=>"applyPrice(this);"]) !!}
                    </td>
                    <td>
                        {!!  Form::number('stageDecorations[discount][]',$stageDecoration->pivot->discount,['min'=>'0','id'=>'stageDecorations[discount][]','class'=>'form-control  current_discount','placeholder'=>'','onkeyup'=>'applyDiscount(this);','onchange'=>"applyDiscount(this);"]) !!}
                    </td>
                    <td>
                        {!!  Form::number('stageDecorations[total][]',$stageDecoration->pivot->total,['id'=>'oodItems[total][]','class'=>'form-control  current_total','placeholder'=>'','readonly','oninput'=>"this.value = Math.abs(this.value)"]) !!}
                    </td>
                    <td class="text-center">
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
                    {!! Form::text('stageDecorations[name][]',null,['id'=>'stageDecorations[name][]','class'=>'form-control current_product stage_decoration_name','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingForStageDecorations(this);', 'autocomplete'=>'off']) !!}
                </td>
                <td>
                    {!!  Form::number('stageDecorations[quantity][]',null,['min'=>'0','id'=>'stageDecorations[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','onchange'=>"applyQuantity(this);"]) !!}
                </td>

                <td>
                    {!!  Form::number('stageDecorations[price][]',null,['min'=>'0','id'=>'oodItems[price][]','class'=>'form-control  current_price','placeholder'=>'','onkeyup'=>'applyPrice(this);','onchange'=>"applyPrice(this);"]) !!}
                </td>
                <td>
                    {!!  Form::number('stageDecorations[discount][]',null,['min'=>'0','id'=>'stageDecorations[discount][]','class'=>'form-control  current_discount','placeholder'=>'','onkeyup'=>'applyDiscount(this);','onchange'=>"applyDiscount(this);"]) !!}
                </td>
                <td>
                    {!!  Form::number('stageDecorations[total][]',null,['id'=>'oodItems[total][]','class'=>'form-control  current_total','placeholder'=>'','readonly','oninput'=>"this.value = Math.abs(this.value)"]) !!}
                </td>
                <td class="text-center">
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
                {!! Form::text('stageDecorations[name][]',null,['min'=>'0','id'=>'stageDecorations[name][]','class'=>'form-control current_product stage_decoration_name','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingForStageDecorations(this);', 'autocomplete'=>'off']) !!}
            </td>
            <td>
                {!!  Form::number('stageDecorations[quantity][]',null,['min'=>'0','id'=>'stageDecorations[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','onchange'=>"applyQuantity(this);"]) !!}
            </td>

            <td>
                {!!  Form::number('stageDecorations[price][]',null,['min'=>'0','id'=>'oodItems[price][]','class'=>'form-control  current_price','placeholder'=>'','onkeyup'=>'applyPrice(this);','onchange'=>"applyPrice(this);"]) !!}
            </td>
            <td>
                {!!  Form::number('stageDecorations[discount][]',null,['min'=>'0','id'=>'stageDecorations[discount][]','class'=>'form-control  current_discount','placeholder'=>'','onkeyup'=>'applyDiscount(this);','onchange'=>"applyDiscount(this);"]) !!}
            </td>
            <td>
                {!!  Form::number('stageDecorations[total][]',null,['id'=>'oodItems[total][]','class'=>'form-control  current_total','placeholder'=>'','readonly','oninput'=>"this.value = Math.abs(this.value)"]) !!}
            </td>
            <td class="text-center">
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
