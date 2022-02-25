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
        @if (isset($for))
            @if (count($model->extraFoodItems))
            
                @foreach ($model->extraFoodItems as $foodItem)
                    <tr>
                        <td>
                            {!! Form::hidden('extraFoodItems[id][]', $foodItem->id, ['class' => 'current_id']) !!}
                            {!! Form::text('extraFoodItems[name][]', $foodItem->name, ['id' => 'extraFoodItems[name][]', 'class' => 'form-control current_item current_new_item', 'placeholder' => 'Search Name', 'onkeypress' => 'applySearchingForExtraFoodItems(this);', 'autocomplete' => 'off']) !!}
                        </td>
                        <td> {!! Form::number('extraFoodItems[quantity][]', $foodItem->pivot->quantity, ['min' => '0', 'step' => 'any', 'id' => 'extraFoodItems[quantity][]', 'class' => 'form-control  current_quantity', 'placeholder' => '0', 'onkeyup' => 'applyQuantity(this);', 'onchange' => "'applyQuantity(this);"]) !!} </td>
                        <td>
                            {!! Form::number('extraFoodItems[price][]', $foodItem->pivot->price, ['min' => '0', 'id' => 'extraFoodItems[price][]', 'class' => 'form-control  current_price', 'placeholder' => '0.00', 'onkeyup' => 'applyPriceOnly(this);', 'onchange' => 'applyPriceOnly(this);']) !!}
                        </td>
                        <td>
                        {!! Form::number('extraFoodItems[total][]', $foodItem->pivot->total, ['id' => 'extraFoodItems[total][]', 'class' => 'form-control  current_total', 'placeholder' => '0.00', 'readonly', 'tabindex' => -1]) !!}
                        </td>
                        <td>
                            {!! Form::text('extraFoodItems[details][]', $foodItem->pivot->details, ['id' => 'extraFoodItems[details][]', 'class' => 'form-control  current_detail', 'placeholder' => '']) !!}
                        </td>
                        <td class="text-center">
                            <a href="javascript:void(0);" onclick="removeClonedRow(this);" class="btn btn-xs btn-danger">
                                <i class="fas fa-times-circle"></i>
                            </a>
                            <a href="javascript:void(0);" onclick="cloneRow(this);" class="btn btn-xs btn-info">
                                <i class="fas fa-plus-circle"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>
                        {!! Form::hidden('extraFoodItems[id][]', null, ['class' => 'current_id']) !!}
                        {!! Form::text('extraFoodItems[name][]', null, ['id' => 'extraFoodItems[name][]', 'class' => 'form-control current_new_item', 'placeholder' => 'Search Name', 'onkeypress' => 'applySearchingForExtraFoodItems(this);', 'autocomplete' => 'off']) !!}
                    </td>
                    <td>
                    {!!  Form::number('extraFoodItems[quantity][]',null,['min'=>'0','step'=>"any",'id'=>'extraFoodItems[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'0','onkeyup'=>'applyQuantity(this);','onchange'=>"'applyQuantity(this);"]) !!}
                    </td>
                    <td>
                        {!! Form::number('extraFoodItems[price][]', null, ['min' => '0', 'id' => 'extraFoodItems[price][]', 'class' => 'form-control  current_price', 'placeholder' => '0.00', 'onkeyup' => 'applyPriceOnly(this);', 'onchange' => 'applyPriceOnly(this);']) !!}
                    </td>
                <td>
                    {!! Form::number('extraFoodItems[total][]', null, ['id' => 'extraFoodItems[total][]', 'class' => 'form-control  current_total', 'placeholder' => '0.00', 'readonly', 'tabindex' => -1]) !!}
                </td>
                    <td>
                        {!! Form::text('extraFoodItems[details][]', null, ['id' => 'extraFoodItems[details][]', 'class' => 'form-control  current_detail', 'placeholder' => '']) !!}
                    </td>
                    <td class="text-center">
                        <a href="javascript:void(0);" onclick="removeClonedRow(this);" class="btn btn-xs btn-danger">
                            <i class="fas fa-times-circle"></i>
                        </a>
                        <a href="javascript:void(0);" onclick="cloneRow(this);" class="btn btn-xs btn-info">
                            <i class="fas fa-plus-circle"></i>
                        </a>
                    </td>
                </tr>
            @endif
        @else
           
                <td>
                    {!! Form::hidden('extraFoodItems[id][]', null, ['class' => 'current_id']) !!}
                    {!! Form::text('extraFoodItems[name][]', null, ['id' => 'extraFoodItems[name][]', 'class' => 'form-control current_new_item', 'placeholder' => 'Search Name', 'onkeypress' => 'applySearchingForExtraFoodItems(this);', 'autocomplete' => 'off']) !!}
                </td>
                <td>
                {!!  Form::number('extraFoodItems[quantity][]',null,['min'=>'0','step'=>"any",'id'=>'extraFoodItems[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','onchange'=>"applyQuantity(this);"]) !!}
                </td>
                <td>
                    {!! Form::number('extraFoodItems[price][]', null, ['min' => '0', 'id' => 'extraFoodItems[price][]', 'class' => 'form-control  current_price', 'placeholder' => '0.00', 'onkeyup' => 'applyPriceOnly(this);', 'onchange' => 'applyPriceOnly(this);']) !!}
                </td>
            <td>
                {!! Form::number('extraFoodItems[total][]', null, ['id' => 'extraFoodItems[total][]', 'class' => 'form-control  current_total', 'placeholder' => '0.00', 'readonly', 'tabindex' => -1]) !!}
            </td>
                <td>
                    {!! Form::text('extraFoodItems[details][]', null, ['id' => 'extraFoodItems[details][]', 'class' => 'form-control  current_detail', 'placeholder' => '']) !!}
                </td>
                <td class="text-center">
                    <a href="javascript:void(0);" onclick="removeClonedRow(this);" class="btn btn-xs btn-danger">
                        <i class="fas fa-times-circle"></i>
                    </a>
                    <a href="javascript:void(0);" onclick="cloneRow(this);" class="btn btn-xs btn-info">
                        <i class="fas fa-plus-circle"></i>
                    </a>
                </td>
            </tr>
        @endif
    </tbody>
</table>
