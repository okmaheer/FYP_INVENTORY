<table class="table table-bordered table-hover">
    <thead class="thead-light">
        <tr>
            <th class="text-center product_field">Dish Name</th>
            <th class="text-center">Unit</th>
            <th class="text-center">Price<i class="text-danger">*</i></th>
            <th class="text-center">Quantity<i class="text-danger">*</i></th>
            <th class="text-center">Total Amount</th>
            <th class="text-center col-2">Action</th>
        </tr>
    </thead>
    <tbody id="ingrediets_item_body">
    @if(isset($for))
        @if(count($model->menuItems))
            @foreach($model->menuItems as $menuItem)
        <tr>
            <td>
                {!! Form::text('products[name][]',$menuItem->product_name,['id'=>'products[name[]','placeholder'=>'','class'=>'form-control current_product','onkeypress'=>'applySearchingOnDishes(this);', 'autocomplete'=>'off']) !!}
                {!! Form::hidden('products[id][]',$menuItem->id,['class'=>'current_id']) !!}
            </td>
            <td>
                {!!  Form::text('products[unit][]',$menuItem->units->unit_name,['id'=>'products[unit][]','class'=>'form-control current_unit', 'readonly', 'tabindex'=>'-1']) !!}
            </td>
            <td>
                {!!  Form::number('products[price][]',number_format($menuItem->pivot->price,2),['step'=>'any','min'=>'0','id'=>'products[price][]','class'=>'form-control current_price text-right','onkeyup'=>'applyQuantity(this);','onchange'=>'applyQuantity(this);', 'required']) !!}
            </td>
            <td>
                {!!  Form::number('products[quantity][]',$menuItem->pivot->quantity,['step'=>'any','min'=>'0','id'=>'products[quantity][]','class'=>'form-control current_quantity','onkeyup'=>'applyQuantity(this);','onchange'=>'applyQuantity(this);', 'required']) !!}
            </td>
            <td>
                {!!  Form::text('products[total_amount][]',$menuItem->pivot->total,['id'=>'products[total_amount][]','class'=>'form-control current_total text-right','readonly', 'tabindex'=>'-1']) !!}
            </td>
            <td class="text-center">
                <a href="javascript:void(0);"
                    onclick="removeClonedRow(this);"
                    class="btn btn-sm btn-danger">
                    <i class="fas fa-times-circle"></i>
                </a>
                <a href="javascript:void(0);"
                    onclick="cloneRow(this);"
                    class="btn btn-sm btn-info">
                    <i class="fas fa-plus-circle"></i>
                </a>
            </td>
        </tr>
            @endforeach
        @else
        <tr>
            <td>
                {!! Form::text('products[name][]',null,['id'=>'products[name[]','placeholder'=>'','class'=>'form-control current_product','onkeypress'=>'applySearchingOnDishes(this);', 'autocomplete'=>'off']) !!}
                {!! Form::hidden('products[id][]',null,['class'=>'current_id']) !!}
            </td>
            <td>
                {!!  Form::text('products[unit][]',null,['id'=>'products[unit][]','class'=>'form-control current_unit', 'readonly', 'tabindex'=>'-1']) !!}
            </td>
            <td>
                {!!  Form::number('products[price][]',null,['step'=>'any','min'=>'0','id'=>'products[price][]','class'=>'form-control current_price text-right','onkeyup'=>'applyQuantity(this);','onchange'=>'applyQuantity(this);', 'required']) !!}
            </td>
            <td>
                {!!  Form::number('products[quantity][]',null,['step'=>'any','min'=>'0','id'=>'products[quantity][]','class'=>'form-control current_quantity','onkeyup'=>'applyQuantity(this);','onchange'=>'applyQuantity(this);', 'required']) !!}
            </td>
            <td>
                {!!  Form::text('products[total_amount][]',null,['id'=>'products[total_amount][]','class'=>'form-control current_total text-right','readonly', 'tabindex'=>'-1']) !!}
            </td>
            <td class="text-center">
                <a href="javascript:void(0);"
                    onclick="removeClonedRow(this);"
                    class="btn btn-sm btn-danger">
                    <i class="fas fa-times-circle"></i>
                </a>
                <a href="javascript:void(0);"
                    onclick="cloneRow(this);"
                    class="btn btn-sm btn-info">
                    <i class="fas fa-plus-circle"></i>
                </a>
            </td>
        </tr>
        @endif
    @else
        <tr>
            <td>
                {!! Form::text('products[name][]',null,['id'=>'products[name[]','placeholder'=>'','class'=>'form-control current_product','onkeypress'=>'applySearchingOnDishes(this);', 'autocomplete'=>'off']) !!}
                {!! Form::hidden('products[id][]',null,['class'=>'current_id']) !!}
            </td>
            <td>
                {!!  Form::text('products[unit][]',null,['id'=>'products[unit][]','class'=>'form-control current_unit', 'readonly', 'tabindex'=>'-1']) !!}
            </td>
            <td>
                {!!  Form::number('products[price][]',null,['step'=>'any','min'=>'0','id'=>'products[price][]','class'=>'form-control current_price text-right','onkeyup'=>'applyQuantity(this);','onchange'=>'applyQuantity(this);', 'required']) !!}
            </td>
            <td>
                {!!  Form::number('products[quantity][]',null,['step'=>'any','min'=>'0','id'=>'products[quantity][]','class'=>'form-control current_quantity','onkeyup'=>'applyQuantity(this);','onchange'=>'applyQuantity(this);', 'required']) !!}
            </td>
            <td>
                {!!  Form::text('products[total_amount][]',null,['id'=>'products[total_amount][]','class'=>'form-control current_total text-right','readonly', 'tabindex'=>'-1']) !!}
            </td>
            <td class="text-center">
                <a href="javascript:void(0);"
                    onclick="removeClonedRow(this);"
                    class="btn btn-sm btn-danger">
                    <i class="fas fa-times-circle"></i>
                </a>
                <a href="javascript:void(0);"
                    onclick="cloneRow(this);"
                    class="btn btn-sm btn-info">
                    <i class="fas fa-plus-circle"></i>
                </a>
            </td>
        </tr>
    @endif
    </tbody>
</table>
