<table class="table table-bordered table-hover" id="product_table">
    <thead class="thead-light">
        <tr>
            <th class="text-center">{{trans('accounts.general.item_info')}}<i class="text-danger">*</i></th>
            <th class="text-center">{{trans('accounts.general.av_qty')}}</th>
            <th class="text-center">{{trans('accounts.general.qty')}}<i class="text-danger">*</i></th>
            <th class="text-center">{{trans('accounts.general.price')}}<i class="text-danger">*</i></th>
            <th class="text-center">{{trans('accounts.general.tax_percent')}}</th>
            <th class="text-center">{{trans('accounts.general.total')}}<i class="text-danger">*</i></th>
            <th class="text-center">{{trans('accounts.general.action')}}</th>
        </tr>
    </thead>
    <tbody id="addPurchaseItem">
    @if(isset($for))
        @if(count($model->purchaseDetails))
            @foreach($model->purchaseDetails as $purchaseDetail)
                <tr>
                    <td>
                        {!!  Form::text('purchaseItem[name][]',$purchaseDetail->product->product_name,['id'=>'purchaseItem[name][]','class'=>'form-control current_product', 'placeholder'=>__('accounts.general.product_name') ,'onkeypress'=>'applySearchingOnItems(this);', 'autocomplete'=>'off', 'required']) !!}
                        {!!  Form::hidden('purchaseItem[id][]', $purchaseDetail->product_id,['id'=>'purchaseItem[id][]','class'=>'current_id', 'required']) !!}
                    </td>
                    <td>
                        {!!  Form::text('purchaseItem[available][]',\AccountHelper::getProductStock($purchaseDetail->product_id),['id'=>'purchaseItem[available][]','class'=>'form-control text-right current_qty_available','placeholder'=>'0.00','readonly', 'tabindex' => '-1']) !!}
                    </td>
                    <td>
                        {!!  Form::number('purchaseItem[qty][]',$purchaseDetail->quantity,['step'=>'any','min'=>'1', 'id'=>'purchaseItem[qty][]','class'=>'form-control text-right current_quantity','placeholder'=>'0.00','onkeyup'=>'applyQuantity(this);','onchange'=>'applyQuantity(this);', 'required', 'autocomplete'=>'off']) !!}
                    </td>
                    <td>
                        {!!  Form::number('purchaseItem[rate][]',$purchaseDetail->rate,['step'=>'any','min'=>'1','id'=>'purchaseItem[rate][]','class'=>'form-control text-right current_price','placeholder'=>'0.00','onkeyup'=>'applyPrice(this);','onchange'=>'applyPrice(this);', 'required', 'autocomplete'=>'off']) !!}
                    </td>
                    <td>
                        {!!  Form::number('purchaseItem[tax][]',$purchaseDetail->tax_p,['step'=>'any','min'=>'0','id'=>'purchaseItem[tax][]','class'=>'form-control text-right current_tax','placeholder'=>'0.00','onkeyup'=>'applyTax(this);','onchange'=>'applyTax(this);', 'autocomplete'=>'off']) !!}
                        {!!  Form::hidden('purchaseItem[tax_amount][]', $purchaseDetail->tax_amount,['id'=>'purchaseItem[tax_amount][]','class'=>'current_tax_amount']) !!}
                    </td>
                    <td>
                        {!!  Form::text('purchaseItem[total][]',\AccountHelper::number_format( $purchaseDetail->total_amount),['id'=>'purchaseItem[total][]','class'=>'form-control text-right current_total','placeholder'=>'0.00','readonly', 'tabindex' => '-1', 'required']) !!}
                    </td>
                    <td class="text-center">

                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td>
                    {!!  Form::text('purchaseItem[name][]',null,['id'=>'purchaseItem[name][]','class'=>'form-control current_product', 'placeholder'=>__('accounts.general.product_name') ,'onkeypress'=>'applySearchingOnItems(this);', 'autocomplete'=>'off', 'required']) !!}
                    {!!  Form::hidden('purchaseItem[id][]', null,['id'=>'purchaseItem[id][]','class'=>'current_id', 'required']) !!}
                </td>
                <td>
                    {!!  Form::text('purchaseItem[available][]',null,['id'=>'purchaseItem[available][]','class'=>'form-control text-right current_qty_available','placeholder'=>'0.00','readonly', 'tabindex' => '-1']) !!}
                </td>
                <td>
                    {!!  Form::number('purchaseItem[qty][]',null,['step'=>'any','min'=>'1', 'id'=>'purchaseItem[qty][]','class'=>'form-control text-right current_quantity','placeholder'=>'0.00','onkeyup'=>'applyQuantity(this);','onchange'=>'applyQuantity(this);', 'required', 'autocomplete'=>'off']) !!}
                </td>
                <td>
                    {!!  Form::number('purchaseItem[rate][]',null,['step'=>'any','min'=>'1','id'=>'purchaseItem[rate][]','class'=>'form-control text-right current_price','placeholder'=>'0.00','onkeyup'=>'applyPrice(this);','onchange'=>'applyPrice(this);', 'required', 'autocomplete'=>'off']) !!}
                </td>
                <td>
                    {!!  Form::number('purchaseItem[tax][]',null,['step'=>'any','min'=>'0','id'=>'purchaseItem[tax][]','class'=>'form-control text-right current_tax','placeholder'=>'0.00','onkeyup'=>'applyTax(this);','onchange'=>'applyTax(this);', 'autocomplete'=>'off']) !!}
                    {!!  Form::hidden('purchaseItem[tax_amount][]', null,['id'=>'purchaseItem[tax_amount][]','class'=>'current_tax_amount']) !!}
                </td>
                <td>
                    {!!  Form::text('purchaseItem[total][]',null,['id'=>'purchaseItem[total][]','class'=>'form-control text-right current_total','placeholder'=>'0.00','readonly', 'tabindex' => '-1', 'required']) !!}
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
                {!!  Form::text('purchaseItem[name][]',null,['id'=>'purchaseItem[name][]','class'=>'form-control current_product', 'placeholder'=>__('accounts.general.product_name') ,'onkeypress'=>'applySearchingOnItems(this);', 'autocomplete'=>'off', 'required']) !!}
                {!!  Form::hidden('purchaseItem[id][]', null,['id'=>'purchaseItem[id][]','class'=>'current_id', 'required']) !!}
            </td>
            <td>
                {!!  Form::text('purchaseItem[available][]',null,['id'=>'purchaseItem[available][]','class'=>'form-control text-right current_qty_available','placeholder'=>'0.00','readonly', 'tabindex' => '-1']) !!}
            </td>
            <td>
                {!!  Form::number('purchaseItem[qty][]',null,['step'=>'any','min'=>'1', 'id'=>'purchaseItem[qty][]','class'=>'form-control text-right current_quantity','placeholder'=>'0.00','onkeyup'=>'applyQuantity(this);','onchange'=>'applyQuantity(this);', 'required', 'autocomplete'=>'off']) !!}
            </td>
            <td>
                {!!  Form::number('purchaseItem[rate][]',null,['step'=>'any','min'=>'1','id'=>'purchaseItem[rate][]','class'=>'form-control text-right current_price','placeholder'=>'0.00','onkeyup'=>'applyPrice(this);','onchange'=>'applyPrice(this);', 'required', 'autocomplete'=>'off']) !!}
            </td>
            <td>
                {!!  Form::number('purchaseItem[tax][]',null,['step'=>'any','min'=>'0','id'=>'purchaseItem[tax][]','class'=>'form-control text-right current_tax','placeholder'=>'0.00','onkeyup'=>'applyTax(this);','onchange'=>'applyTax(this);', 'autocomplete'=>'off']) !!}
                {!!  Form::hidden('purchaseItem[tax_amount][]', null,['id'=>'purchaseItem[tax_amount][]','class'=>'current_tax_amount']) !!}
            </td>
            <td>
                {!!  Form::text('purchaseItem[total][]',null,['id'=>'purchaseItem[total][]','class'=>'form-control text-right current_total','placeholder'=>'0.00','readonly', 'tabindex' => '-1', 'required']) !!}
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
