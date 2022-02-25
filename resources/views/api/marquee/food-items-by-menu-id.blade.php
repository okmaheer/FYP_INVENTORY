@if ($reset == false)
    @if(count($model->products))
        @foreach($model->menuItems as $product)
            <tr>
                <td>
                    {!! Form::hidden('foodItems[id][]',$product->id,['class'=>'current_id']) !!}
                    {!! Form::text('foodItems[name][]',$product->product_name,['id'=>'foodItems[name][]','class'=>'form-control current_product current_menu_product','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingOnMenu(this);', 'autocomplete'=>'off']) !!}
                </td>
                <td>
                    {!!  Form::number('foodItems[quantity][]',$product->pivot->quantity,['step'=>'any','min'=>'0','id'=>'foodItems[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'0','onkeyup'=>'applyQuantity(this);','onchange'=>"applyQuantity(this);"]) !!}
                </td>
                <td>
                    {!!  Form::number('foodItems[price][]',$product->pivot->price,['step'=>'any','min'=>'0','id'=>'foodItems[price][]','class'=>'form-control  current_price','placeholder'=>'0.00','onkeyup'=>'applyPrice(this);','onchange'=>"applyPrice(this);"]) !!}
                </td>
                <td>
                    {!!  Form::text('foodItems[total][]',$product->pivot->total,['id'=>'foodItems[total][]','class'=>'form-control  current_total','placeholder'=>'0.00','readonly','tabindex' => '-1']) !!}
                </td>
                <td>
                    {!!  Form::text('foodItems[details][]',$product->pivot->details,['id'=>'foodItems[details][]','class'=>'form-control  current_detail','placeholder'=>'']) !!}
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
    @endif
@else
    <tr>
        <td>
            {!! Form::hidden('foodItems[id][]',null,['class'=>'current_id']) !!}
            {!! Form::text('foodItems[name][]',null,['id'=>'foodItems[name][]','class'=>'form-control current_product current_menu_product','placeholder'=>'Search Name', 'autocomplete'=>'off', 'onkeypress'=>'applySearchingOnMenu(this);']) !!}
        </td>
        <td>
            {!!  Form::number('foodItems[quantity][]',null,['step'=>'any','min'=>'0','id'=>'foodItems[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'0','onkeyup'=>'applyQuantity(this);','onchange'=>"applyQuantity(this);"]) !!}
        </td>
        <td>
            {!!  Form::number('foodItems[price][]',null,['step'=>'any','min'=>'0','id'=>'foodItems[price][]','class'=>'form-control  current_price','placeholder'=>'0.00','onkeyup'=>'applyPrice(this);','onchange'=>"applyPrice(this);"]) !!}
        </td>
        <td>
            {!!  Form::text('foodItems[total][]',null,['id'=>'foodItems[total][]','class'=>'form-control  current_total','placeholder'=>'0.00','readonly','tabindex' => '-1']) !!}
        </td>
        <td>
            {!!  Form::text('foodItems[details][]',null,['id'=>'foodItems[details][]','class'=>'form-control  current_detail','placeholder'=>'']) !!}
        </td>
        <td class="text-center">
            <a href="javascript:void(0);" tabindex = "18"
                onclick="removeClonedRow(this);"
                class="btn btn-xs btn-danger">
                <i class="fas fa-times-circle"></i>
            </a>
            <a href="javascript:void(0);" tabindex = "19"
                onclick="cloneRow(this);"
                class="btn btn-xs btn-info">
                <i class="fas fa-plus-circle"></i>
            </a>
        </td>
    </tr>
@endif
