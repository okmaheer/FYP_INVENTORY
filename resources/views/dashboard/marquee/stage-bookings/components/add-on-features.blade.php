<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th class="text-center product_field">Select Services/Items
        </th>
        <th class="text-center">Stock/Qty
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
            {!! Form::hidden('addOnFeatures[id][]',null,['class'=>'current_id']) !!}
            {!! Form::text('addOnFeatures[name][]',null,['id'=>'addOnFeatures[name][]','class'=>'form-control current_product add_on_feature_name','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingForAddOn(this);', 'autocomplete'=>'off']) !!}
        </td>
        <td>
            {!!  Form::number('addOnFeatures[quantity][]',null,['step'=>'any','min'=>'0','id'=>'addOnFeatures[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','onchange'=>"applyQuantity(this);"]) !!}
        </td>

        <td>
            {!!  Form::number('addOnFeatures[price][]',null,['step'=>'any','min'=>'0','id'=>'oodItems[price][]','class'=>'form-control  current_price','placeholder'=>'','onkeyup'=>'applyPrice(this);','onchange'=>"applyPrice(this);"]) !!}
        </td>
        <td>
            {!!  Form::number('addOnFeatures[discount][]',null,['step'=>'any','min'=>'0','id'=>'addOnFeatures[discount][]','class'=>'form-control  current_discount','placeholder'=>'','onkeyup'=>'applyDiscount(this);','onchange'=>"applyDiscount(this);"]) !!}
        </td>
        <td>
            {!!  Form::number('addOnFeatures[total][]',null,['step'=>'any','min'=>'0','id'=>'oodItems[total][]','class'=>'form-control  current_total','placeholder'=>'','readonly','oninput'=>"this.value = Math.abs(this.value)",'tabindex'=>'-1']) !!}
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
