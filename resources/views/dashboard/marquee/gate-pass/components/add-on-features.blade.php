<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th class="text-center product_field">Information
        </th>
        <th class="text-center">Stock/Qty
        </th>
        <th class="text-center">Packing Included
        </th>
        <th class="text-center">Description
        </th>
        <th class="text-center">Total No Of Items</th>
        <th class="text-center">Action</th>
    </tr>
    </thead>
    <tbody id="food_items_body">
    <tr id="row">
        <td>
            {!! Form::hidden('hardwareItems[id][]',null,['class'=>'current_id']) !!}
            {!! Form::text('hardwareItems[name][]',null,['id'=>'hardwareItems[name][]','class'=>'form-control current_product current_menu_product','placeholder'=>'Product Name', 'onkeypress'=>'applySearchingOnMenu(this);']) !!}

        </td>
        <td>
            {!!  Form::number('hardwareItems[quantity][]',null,['min'=>'0','id'=>'hardwareItems[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','oninput'=>"this.value = Math.abs(this.value)"]) !!}
        </td>
        <td>
            {!!  Form::text('hardwareItems[packing][]',null,['min'=>'0','id'=>'hardwareItems[packing][]','class'=>'form-control ','placeholder'=>'Packing']) !!}
        </td>
        <td>
            {!!  Form::text('hardwareItems[description][]',null,['min'=>'0','id'=>'hardwareItems[description][]','class'=>'form-control current_price ','placeholder'=>'description']) !!}
        </td>
        <td>
            {!!  Form::text('hardwareItems[total][]',null,['min'=>'0','id'=>'oodItems[total][]','class'=>'form-control','placeholder'=>'']) !!}
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
    </tbody>
</table>
