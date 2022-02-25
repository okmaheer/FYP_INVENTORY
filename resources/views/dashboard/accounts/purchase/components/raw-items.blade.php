<table class="table table-bordered table-hover" id="food_items_holder">
    <thead>
    <tr>
        <th class="text-center product_field">{{trans('accounts.general.item_info')}}</th>
        <th class="text-center">{{trans('accounts.general.qty')}}</th>
        <th class="text-center">{{trans('accounts.general.price')}}</th>
        <th class="text-center">{{trans('accounts.general.net_total')}}</th>
        <th class="text-center">{{trans('accounts.general.discount')}}</th>
        <th class="text-center">{{trans('accounts.general.total')}}</th>
        <th class="text-center">{{trans('accounts.general.action')}}</th>
    </tr>
    </thead>
    <tbody id="purchase_items_body">
    @if(isset($for))
        @if(count($model->purchaseDetails))
            @foreach($model->purchaseDetails as $purchaseDetail)
                <tr>
                    <td>
                        {!! Form::hidden('purchaseItem[id][]',$purchaseDetail->product_id,['class'=>'current_id']) !!}
                        {!! Form::text('purchaseItem[name][]',$purchaseDetail->product->product_name,['id'=>'purchaseItem[name][]','class'=>'form-control current_product current_menu_product','placeholder'=>'Product Name', 'onkeypress'=>'applySearchingOnRawItems(this);','tabindex' => 12]) !!}
                    </td>
                    <td>
                        {!!  Form::number('purchaseItem[quantity][]',$purchaseDetail->quantity,['min'=>'0','step'=>"any",'id'=>'purchaseItem[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','oninput'=>"this.value = Math.abs(this.value)",'tabindex' => 14]) !!}
                    </td>
                    <td>
                        {!!  Form::number('purchaseItem[price][]',$purchaseDetail->price,['min'=>'0','id'=>'purchaseItem[price][]','class'=>'form-control  current_price','placeholder'=>'','onkeyup'=>'applyPrice(this);','oninput'=>"this.value = Math.abs(this.value)",'tabindex' => 15]) !!}
                    </td>
                    <td>
                        {!!  Form::text('purchaseItem[net_total][]',$purchaseDetail->net_total,['min'=>'0','id'=>'purchaseItem[net_total][]','class'=>'form-control  current_net_total','placeholder'=>'','readonly','oninput'=>"this.value = Math.abs(this.value)"]) !!}
                    </td>
                    <td>
                        {!!  Form::number('purchaseItem[discount][]',$purchaseDetail->discount,['min'=>'0','id'=>'purchaseItem[discount][]','class'=>'form-control  current_discount','placeholder'=>'','onkeyup'=>'applyDiscount(this);','oninput'=>"this.value = Math.abs(this.value)",'tabindex' => 15]) !!}
                    </td>
                    <td>
                        {!!  Form::text('purchaseItem[total][]',$purchaseDetail->total,['min'=>'0','id'=>'purchaseItem[total][]','class'=>'form-control  current_total','placeholder'=>'','readonly','oninput'=>"this.value = Math.abs(this.value)"]) !!}
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
            @endforeach
        @else
            <tr>
                <td>
                    {!! Form::hidden('purchaseItem[id][]',null,['class'=>'current_id']) !!}
                    {!! Form::text('purchaseItem[name][]',null,['id'=>'purchaseItem[name][]','class'=>'form-control current_product','placeholder'=>'Product Name', 'onkeypress'=>'applySearchingOnRawItems(this);','tabindex' => 12]) !!}
                </td>
                <td>
                    {!!  Form::number('purchaseItem[quantity][]',null,['min'=>'0','step'=>"any",'id'=>'purchaseItem[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','oninput'=>"this.value = Math.abs(this.value)",'tabindex' => 14]) !!}
                </td>
                <td>
                    {!!  Form::number('purchaseItem[price][]',null,['min'=>'0','id'=>'purchaseItem[price][]','class'=>'form-control  current_price','placeholder'=>'','onkeyup'=>'applyPrice(this);','oninput'=>"this.value = Math.abs(this.value)",'tabindex' => 13]) !!}
                </td>
                <td>
                    {!!  Form::text('purchaseItem[net_total][]','0.00',['min'=>'0','id'=>'purchaseItem[net_total][]','class'=>'form-control  current_net_total','placeholder'=>'','readonly','oninput'=>"this.value = Math.abs(this.value)",'tabindex' => 17]) !!}
                </td>
                <td>
                    {!!  Form::number('purchaseItem[discount][]',null,['min'=>'0','id'=>'purchaseItem[discount][]','class'=>'form-control  current_discount','placeholder'=>'','onkeyup'=>'applyDiscount(this);','oninput'=>"this.value = Math.abs(this.value)",'tabindex' => 13]) !!}
                </td>
                <td>
                    {!!  Form::text('purchaseItem[total][]','0.00',['min'=>'0','id'=>'purchaseItem[total][]','class'=>'form-control  current_total','placeholder'=>'','readonly','oninput'=>"this.value = Math.abs(this.value)",'tabindex' => 17]) !!}
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
    @else
        <tr>
            <td>
                {!! Form::hidden('purchaseItem[id][]',null,['class'=>'current_id']) !!}
                {!! Form::text('purchaseItem[name][]',null,['id'=>'purchaseItem[name][]','class'=>'form-control current_product','placeholder'=>'Product Name', 'onkeypress'=>'applySearchingOnRawItems(this);','tabindex' => 12]) !!}
            </td>
            <td>
                {!!  Form::number('purchaseItem[quantity][]',null,['min'=>'0','step'=>"any",'id'=>'purchaseItem[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','oninput'=>"this.value = Math.abs(this.value)",'tabindex' => 14]) !!}
            </td>
            <td>
                {!!  Form::number('purchaseItem[price][]',null,['min'=>'0','id'=>'purchaseItem[price][]','class'=>'form-control  current_price','placeholder'=>'','onkeyup'=>'applyPrice(this);','oninput'=>"this.value = Math.abs(this.value)",'tabindex' => 13]) !!}
            </td>
            <td>
                {!!  Form::text('purchaseItem[net_total][]','0.00',['min'=>'0','id'=>'purchaseItem[net_total][]','class'=>'form-control  current_net_total','placeholder'=>'','readonly','oninput'=>"this.value = Math.abs(this.value)",'tabindex' => 17]) !!}
            </td>
            <td>
                {!!  Form::number('purchaseItem[discount][]',null,['min'=>'0','id'=>'purchaseItem[discount][]','class'=>'form-control  current_discount','placeholder'=>'','onkeyup'=>'applyDiscount(this);','oninput'=>"this.value = Math.abs(this.value)",'tabindex' => 13]) !!}
            </td>
            <td>
                {!!  Form::text('purchaseItem[total][]','0.00',['min'=>'0','id'=>'purchaseItem[total][]','class'=>'form-control  current_total','placeholder'=>'','readonly','oninput'=>"this.value = Math.abs(this.value)",'tabindex' => 17]) !!}
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
    </tbody>
</table>
