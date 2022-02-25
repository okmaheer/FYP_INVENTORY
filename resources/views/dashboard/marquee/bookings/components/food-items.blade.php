<table class="table table-bordered table-hover" id="food_items_holder">
    <thead>
        <tr>
            <th class="text-center product_field" style="width: 26%;">Food Item</th>
            <th class="text-center" style="width: 12%;">Qty.</th>
            <th class="text-center" style="width: 12%;">Price</th>
            <th class="text-center" style="width: 12%;">Total</th>
            <th class="text-center" style="width: 26%;">Details</th>
            <th class="text-center" style="width: 12%;">Action</th>
        </tr>
    </thead>
    <tbody id="food_items_body">
    @if(isset($for))
        @if(count($model->foodItems))
            @foreach($model->foodItems as $foodItem)
                <tr>
                    <td>
                        {!! Form::hidden('foodItems[id][]',$foodItem->id,['class'=>'current_id']) !!}
                        {!! Form::text('foodItems[name][]',$foodItem->product_name,['id'=>'foodItems[name][]','class'=>'form-control current_product current_menu_product','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingOnMenu(this);', 'autocomplete'=>'off']) !!}
                    </td>
                    <td>
                        {!!  Form::number('foodItems[quantity][]',$foodItem->pivot->quantity,['min'=>'0','step'=>"any",'id'=>'foodItems[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'0','onkeyup'=>'applyQuantity(this);','onchange'=>"'applyQuantity(this);"]) !!}
                    </td>
                    <td>
                        {!!  Form::number('foodItems[price][]',$foodItem->pivot->price,['min'=>'0','id'=>'foodItems[price][]','class'=>'form-control  current_price','placeholder'=>'0.00','onkeyup'=>'applyPrice(this);','onchange'=>"applyPrice(this);"]) !!}
                    </td>
                    <td>
                        {!!  Form::text('foodItems[total][]',$foodItem->pivot->total,['id'=>'foodItems[total][]','class'=>'form-control  current_total','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
                    </td>
                    <td>
                        {!!  Form::text('foodItems[details][]',$foodItem->pivot->details,['id'=>'foodItems[details][]','class'=>'form-control  current_detail','placeholder'=>'']) !!}
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
                    {!! Form::hidden('foodItems[id][]',null,['class'=>'current_id']) !!}
                    {!! Form::text('foodItems[name][]',null,['id'=>'foodItems[name][]','class'=>'form-control current_product current_menu_product','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingOnMenu(this);', 'autocomplete'=>'off']) !!}
                </td>
                <td>
                    {!!  Form::number('foodItems[quantity][]',null,['min'=>'0','step'=>"any",'id'=>'foodItems[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'0','onkeyup'=>'applyQuantity(this);','onchange'=>"'applyQuantity(this);"]) !!}
                </td>
                <td>
                    {!!  Form::number('foodItems[price][]',null,['min'=>'0','id'=>'foodItems[price][]','class'=>'form-control  current_price','placeholder'=>'0.00','onkeyup'=>'applyPrice(this);','onchange'=>"applyPrice(this);"]) !!}
                </td>
                <td>
                    {!!  Form::text('foodItems[total][]',null,['id'=>'foodItems[total][]','class'=>'form-control  current_total','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
                </td>
                <td>
                    {!!  Form::text('foodItems[details][]',null,['id'=>'foodItems[details][]','class'=>'form-control  current_detail','placeholder'=>'']) !!}
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
                {!! Form::hidden('foodItems[id][]',null,['class'=>'current_id']) !!}
                {!! Form::text('foodItems[name][]',null,['id'=>'foodItems[name][]','class'=>'form-control current_product current_menu_product','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingOnMenu(this);', 'autocomplete'=>'off', 'tabindex' => 19]) !!}
            </td>
            <td>
                {!!  Form::number('foodItems[quantity][]',null,['min'=>'0','step'=>"any",'id'=>'foodItems[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','onchange'=>"applyQuantity(this);"]) !!}
            </td>
            <td>
                {!!  Form::number('foodItems[price][]',null,['min'=>'0','id'=>'foodItems[price][]','class'=>'form-control  current_price','placeholder'=>'0.00','onkeyup'=>'applyPrice(this);','onchange'=>"applyPrice(this);"]) !!}
            </td>
            <td>
                {!!  Form::text('foodItems[total][]',null,['id'=>'foodItems[total][]','class'=>'form-control  current_total','placeholder'=>'0.00','readonly','tabindex' => -1]) !!}
            </td>
            <td>
                {!!  Form::text('foodItems[details][]',null,['id'=>'foodItems[details][]','class'=>'form-control  current_detail','placeholder'=>'']) !!}
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
