<table class="table table-bordered table-hover" id="food_items_holder">
    <thead>
    <tr>
        <th class="text-center product_field">Food Item
            <i class="text-danger">*</i>
        </th>
        <th class="text-center">Quantity
            <i class="text-danger">*</i>
        </th>

        <th class="text-center">Price
        </th>
        <th class="text-center">Discount
        </th>
        <th class="text-center">Total</th>
        <th class="text-center">Action</th>
    </tr>
    </thead>
    <tbody id="food_items_body">
    <tr id="row">
        <td>
            {!! Form::hidden('foodItems[id][]',null,['class'=>'current_id']) !!}
            {!! Form::text('foodItems[name][]',null,['id'=>'foodItems[name][]','class'=>'form-control current_product current_menu_product','placeholder'=>'Product Name', 'onkeypress'=>'applySearchingOnMenu(this);','autocomplete'=>'off']) !!}
        </td>
        <td>
            {!!  Form::number('foodItems[quantity][]',null,['step'=>'any','min'=>'0','id'=>'foodItems[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','onchange'=>"applyQuantity(this);"]) !!}
        </td>

        <td>
            {!!  Form::number('foodItems[price][]',null,['step'=>'any','min'=>'0','id'=>'foodItems[price][]','class'=>'form-control  current_price','placeholder'=>'','onkeyup'=>'applyPrice(this);','onchange'=>"applyPrice(this);"]) !!}
        </td>
        <td>
            {!!  Form::number('foodItems[discount][]',null,['step'=>'any','min'=>'0','id'=>'foodItems[discount][]','class'=>'form-control  current_discount','placeholder'=>'','onkeyup'=>'applyDiscount(this);','onchange'=>"applyDiscount(this);"]) !!}
        </td>
        <td>
            {!!  Form::text('foodItems[total][]',null,['min'=>'0','id'=>'oodItems[total][]','class'=>'form-control  current_total','placeholder'=>'','readonly','oninput'=>"this.value = Math.abs(this.value)", 'tabindex' =>'-1']) !!}
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
    </tbody>
</table>
