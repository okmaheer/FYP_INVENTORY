<table class="table table-bordered table-hover" id="food_items_holder">
    <thead>
    <tr>
        <th class="text-center product_field">Menu Information
            <i class="text-danger">*</i>
        </th>
        <th class="text-center">Rceive Quantity
            <i class="text-danger">*</i>
        </th>
        <th class="text-center">Issue Quantity
            <i class="text-danger">*</i>
        </th>
        <th class="text-center">Action</th>
    </tr>
    </thead>
    <tbody id="food_items_body">
    @if(isset($for))
        @if(count($model->foodItems))
            @foreach($model->foodItems as $foodItem)
                <tr>
                    <td>
                        {!! Form::hidden('foodItems[id][]',$foodItem->id,['class'=>'current_id']) !!}
                        {!! Form::text('foodItems[name][]',$foodItem->product_name,['id'=>'foodItems[name][]','class'=>'form-control current_product current_menu_product','placeholder'=>'Product Name', 'onkeypress'=>'applySearchingOnMenu(this);']) !!}
                    </td>
                    <td>
                        {!!  Form::number('foodItems[quantity][]',$foodItem->pivot->quantity,['min'=>'0','id'=>'foodItems[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','oninput'=>"this.value = Math.abs(this.value)"]) !!}
                    </td>

                    <td>
                        {!!  Form::text('foodItems[total][]',$foodItem->pivot->total,['min'=>'0','id'=>'oodItems[total][]','class'=>'form-control  current_total','placeholder'=>'','oninput'=>"this.value = Math.abs(this.value)"]) !!}
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
                    {!! Form::text('foodItems[name][]',null,['id'=>'foodItems[name][]','class'=>'form-control current_product current_menu_product','placeholder'=>'Product Name', 'onkeypress'=>'applySearchingOnMenu(this);']) !!}
                </td>
                <td>
                    {!!  Form::number('foodItems[quantity][]',null,['min'=>'0','id'=>'foodItems[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','oninput'=>"this.value = Math.abs(this.value)"]) !!}
                </td>

                    {!!  Form::text('foodItems[total][]',null,['min'=>'0','id'=>'oodItems[total][]','class'=>'form-control  current_total','placeholder'=>'','oninput'=>"this.value = Math.abs(this.value)"]) !!}
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
                {!! Form::text('foodItems[name][]',null,['id'=>'foodItems[name][]','class'=>'form-control current_product current_menu_product','placeholder'=>'Product Name', 'onkeypress'=>'applySearchingOnMenu(this);']) !!}
            </td>
            <td>
                {!!  Form::number('foodItems[quantity][]',null,['min'=>'0','id'=>'foodItems[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','oninput'=>"this.value = Math.abs(this.value)"]) !!}
            </td>

            <td>
                {!!  Form::text('foodItems[total][]',null,['min'=>'0','id'=>'oodItems[total][]','class'=>'form-control  current_total','placeholder'=>'','oninput'=>"this.value = Math.abs(this.value)"]) !!}
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
