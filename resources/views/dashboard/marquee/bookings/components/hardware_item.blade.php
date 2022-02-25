<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th class="text-center product_field">Information
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
    @if(isset($for))
        @if(count($model->addOnFeatures))
            @foreach($model->addOnFeatures as $addOnFeature)
                <tr>
                    <td>
                        {!! Form::hidden('addOnFeatures[id][]',$addOnFeature->id,['class'=>'current_id']) !!}
                        {!! Form::text('addOnFeatures[name][]',$addOnFeature->name,['id'=>'addOnFeatures[name][]','class'=>'form-control current_product add_on_feature_name','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingForAddOn(this);']) !!}
                    </td>
                    <td>
                        {!!  Form::number('addOnFeatures[quantity][]',$addOnFeature->pivot->quantity,['min'=>'0','id'=>'addOnFeatures[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','oninput'=>"this.value = Math.abs(this.value)"]) !!}
                    </td>

                    <td>
                        {!!  Form::number('addOnFeatures[price][]',$addOnFeature->pivot->price,['min'=>'0','id'=>'oodItems[price][]','class'=>'form-control  current_price','placeholder'=>'','onkeyup'=>'applyPrice(this);','oninput'=>"this.value = Math.abs(this.value)"]) !!}
                    </td>
                    <td>
                        {!!  Form::number('addOnFeatures[discount][]',$addOnFeature->pivot->discount,['min'=>'0','id'=>'addOnFeatures[discount][]','class'=>'form-control  current_discount','placeholder'=>'','onkeyup'=>'applyDiscount(this);','oninput'=>"this.value = Math.abs(this.value)"]) !!}
                    </td>
                    <td>
                        {!!  Form::number('addOnFeatures[total][]',$addOnFeature->pivot->total,['min'=>'0','id'=>'oodItems[total][]','class'=>'form-control  current_total','placeholder'=>'','readonly','oninput'=>"this.value = Math.abs(this.value)"]) !!}
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
                    {!! Form::hidden('addOnFeatures[id][]',null,['class'=>'current_id']) !!}
                    {!! Form::text('addOnFeatures[name][]',null,['id'=>'addOnFeatures[name][]','class'=>'form-control current_product add_on_feature_name','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingForAddOn(this);']) !!}
                </td>
                <td>
                    {!!  Form::number('addOnFeatures[quantity][]',null,['min'=>'0','id'=>'addOnFeatures[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','oninput'=>"this.value = Math.abs(this.value)"]) !!}
                </td>

                <td>
                    {!!  Form::number('addOnFeatures[price][]',null,['min'=>'0','id'=>'oodItems[price][]','class'=>'form-control  current_price','placeholder'=>'','onkeyup'=>'applyPrice(this);','oninput'=>"this.value = Math.abs(this.value)"]) !!}
                </td>
                <td>
                    {!!  Form::number('addOnFeatures[discount][]',null,['min'=>'0','id'=>'addOnFeatures[discount][]','class'=>'form-control  current_discount','placeholder'=>'','onkeyup'=>'applyDiscount(this);','oninput'=>"this.value = Math.abs(this.value)"]) !!}
                </td>
                <td>
                    {!!  Form::number('addOnFeatures[total][]',null,['min'=>'0','id'=>'oodItems[total][]','class'=>'form-control  current_total','placeholder'=>'','readonly','oninput'=>"this.value = Math.abs(this.value)"]) !!}
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
                {!! Form::hidden('addOnFeatures[id][]',null,['class'=>'current_id']) !!}
                {!! Form::text('addOnFeatures[name][]',null,['id'=>'addOnFeatures[name][]','class'=>'form-control current_product add_on_feature_name','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingForAddOn(this);']) !!}
            </td>
            <td>
                {!!  Form::number('addOnFeatures[quantity][]',null,['min'=>'0','id'=>'addOnFeatures[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','oninput'=>"this.value = Math.abs(this.value)"]) !!}
            </td>

            <td>
                {!!  Form::number('addOnFeatures[price][]',null,['min'=>'0','id'=>'oodItems[price][]','class'=>'form-control  current_price','placeholder'=>'','onkeyup'=>'applyPrice(this);','oninput'=>"this.value = Math.abs(this.value)"]) !!}
            </td>
            <td>
                {!!  Form::number('addOnFeatures[discount][]',null,['min'=>'0','id'=>'addOnFeatures[discount][]','class'=>'form-control  current_discount','placeholder'=>'','onkeyup'=>'applyDiscount(this);','oninput'=>"this.value = Math.abs(this.value)"]) !!}
            </td>
            <td>
                {!!  Form::number('addOnFeatures[total][]',null,['id'=>'oodItems[total][]','class'=>'form-control  current_total','placeholder'=>'','readonly','oninput'=>"this.value = Math.abs(this.value)"]) !!}
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
