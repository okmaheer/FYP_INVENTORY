<div class="row">
    <div class="col-12">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th class="text-center">{{ __('accounts.general.item_info') }}<i class="text-danger">*</i></th>
                    <th class="text-center">{{ __('accounts.general.desc') }}</th>
                    <th class="text-center">{{ __('accounts.general.av_qty') }}</th>
                    <th class="text-center">{{ __('accounts.general.qty') }}<i class="text-danger">*</i></th>
                    <th class="text-center">{{ __('accounts.general.price') }}<i class="text-danger">*</i></th>
                    <th class="text-center">{{ __('accounts.general.tax_percent') }}</th>
                    <th class="text-center">{{ __('accounts.general.discount_percent') }}</th>
                    <th class="text-center">{{ __('accounts.general.total') }}<i class="text-danger">*</i></th>
                    <th class="text-center">{{ __('accounts.general.action') }}</th>
                </tr>
            </thead>
            <tbody>
            @if(isset($for))
                @if(count($model->invoiceDetails))
                    @foreach($model->invoiceDetails as $invoiceDetail)
                        <tr>
                            <td>
                                {!! Form::text('invoiceItem[name][]',$invoiceDetail->product->product_name,['id'=>'invoiceItem[name][]','class'=>'form-control current_product','placeholder'=>__('accounts.general.product_name'), 'onkeypress'=>'applySearchingOnItems(this);', 'autocomplete'=>'off', 'required']) !!}
                                {!! Form::hidden('invoiceItem[id][]', $invoiceDetail->product_id,['id'=>'invoiceItem[id][]','class'=>'current_id', 'required']) !!}
                            </td>
                            <td>
                                {!!  Form::text('invoiceItem[desc][]',$invoiceDetail->description,['id'=>'invoiceItem[desc][]','class'=>'form-control']) !!}
                            </td>
                            <td>
                                {!!  Form::text('invoiceItem[available][]',\AccountHelper::getProductStock($invoiceDetail->product_id),['id'=>'invoiceItem[available][]','class'=>'form-control text-right current_qty_available','placeholder'=>'0.00','readonly'=>'', 'tabindex'=>'-1']) !!}
                            </td>
                            <td>
                                {!!  Form::number('invoiceItem[qty][]',$invoiceDetail->quantity,['step'=>'any','min'=>'1','id'=>'invoiceItem[qty][]','class'=>'form-control text-right current_quantity','placeholder'=>'0','onkeyup'=>'applyRowCalculation(this);','onchange'=>'applyRowCalculation(this);', 'required', 'autocomplete'=>'off']) !!}
                            </td>
                            <td>
                                {!!  Form::number('invoiceItem[rate][]',$invoiceDetail->rate,['step'=>'any','min'=>'1','id'=>'invoiceItem[rate][]','class'=>'form-control text-right current_price','placeholder'=>'0.00','onkeyup'=>'applyRowCalculation(this);','onchange'=>'applyRowCalculation(this);', 'required', 'autocomplete'=>'off']) !!}
                                {!!  Form::hidden('invoiceItem[supplier_rate][]',$invoiceDetail->supplier_rate,['id'=>'invoiceItem[supplier_rate][]', 'class' =>'current_supplier_price']) !!}
                            </td>
                            <td>
                                {!!  Form::number('invoiceItem[tax][]',$invoiceDetail->tax_p,['step'=>'any','min'=>'0','id'=>'invoiceItem[tax][]','class'=>'form-control text-right current_tax','placeholder'=>'0.00','onkeyup'=>'applyRowCalculation(this);','onchange'=>'applyRowCalculation(this);', 'autocomplete'=>'off']) !!}
                                {!!  Form::hidden('invoiceItem[tax_amount][]', $invoiceDetail->tax_amount,['id'=>'invoiceItem[tax_amount][]','class'=>'current_tax_amount']) !!}
                            </td>
                            <td>
                                {!!  Form::number('invoiceItem[discount][]',$invoiceDetail->discount_per,['step'=>'any','min'=>'0','id'=>'invoiceItem[discount][]','class'=>'form-control text-right current_discount','placeholder'=>'0.00','onkeyup'=>'applyRowCalculation(this);','onchange'=>'applyRowCalculation(this);', 'autocomplete'=>'off']) !!}
                                {!!  Form::hidden('invoiceItem[discount_amount][]', $invoiceDetail->discount,['class'=>'current_discount_amount']) !!}
                            </td>
                            <td>
                                {!!  Form::text('invoiceItem[total][]',\AccountHelper::number_format($invoiceDetail->total_price),['id'=>'invoiceItem[total][]','class'=>'form-control text-right current_total','placeholder'=>'0.00','readonly', 'tabindex'=>'-1', 'required']) !!}
                            </td>
                            <td class="text-center">

                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>
                            {!! Form::text('invoiceItem[name][]',null,['id'=>'invoiceItem[name][]','class'=>'form-control current_product','placeholder'=>__('accounts.general.product_name'), 'onkeypress'=>'applySearchingOnItems(this);', 'autocomplete'=>'off', 'required']) !!}
                            {!! Form::hidden('invoiceItem[id][]', null,['id'=>'invoiceItem[id][]','class'=>'current_id', 'required']) !!}
                        </td>
                        <td>
                            {!!  Form::text('invoiceItem[desc][]',null,['id'=>'invoiceItem[desc][]','class'=>'form-control']) !!}
                        </td>
                        <td>
                            {!!  Form::text('invoiceItem[available][]',null,['id'=>'invoiceItem[available][]','class'=>'form-control text-right current_qty_available','placeholder'=>'0.00','readonly'=>'', 'tabindex'=>'-1']) !!}
                        </td>
                        <td>
                            {!!  Form::number('invoiceItem[qty][]',null,['step'=>'any','min'=>'1','id'=>'invoiceItem[qty][]','class'=>'form-control text-right current_quantity','placeholder'=>'0','onkeyup'=>'applyRowCalculation(this);','onchange'=>'applyRowCalculation(this);', 'required', 'autocomplete'=>'off']) !!}
                        </td>
                        <td>
                            {!!  Form::number('invoiceItem[rate][]',null,['step'=>'any','min'=>'1','id'=>'invoiceItem[rate][]','class'=>'form-control text-right current_price','placeholder'=>'0.00','onkeyup'=>'applyRowCalculation(this);','onchange'=>'applyRowCalculation(this);', 'required', 'autocomplete'=>'off']) !!}
                            {!!  Form::hidden('invoiceItem[supplier_rate][]',null,['id'=>'invoiceItem[supplier_rate][]', 'class' =>'current_supplier_price']) !!}
                        </td>
                        <td>
                            {!!  Form::number('invoiceItem[tax][]',null,['step'=>'any','min'=>'0','id'=>'invoiceItem[tax][]','class'=>'form-control text-right current_tax','placeholder'=>'0.00','onkeyup'=>'applyRowCalculation(this);','onchange'=>'applyRowCalculation(this);', 'autocomplete'=>'off']) !!}
                            {!!  Form::hidden('invoiceItem[tax_amount][]', null,['id'=>'invoiceItem[tax_amount][]','class'=>'current_tax_amount']) !!}
                        </td>
                        <td>
                            {!!  Form::number('invoiceItem[discount][]',null,['step'=>'any','min'=>'0','id'=>'invoiceItem[discount][]','class'=>'form-control text-right current_discount','placeholder'=>'0.00','onkeyup'=>'applyRowCalculation(this);','onchange'=>'applyRowCalculation(this);', 'autocomplete'=>'off']) !!}
                            {!!  Form::hidden('invoiceItem[discount_amount][]', null,['class'=>'current_discount_amount']) !!}
                        </td>
                        <td>
                            {!!  Form::text('invoiceItem[total][]', null,['id'=>'invoiceItem[total][]','class'=>'form-control text-right current_total','placeholder'=>'0.00','readonly', 'tabindex'=>'-1', 'required']) !!}
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
                        {!! Form::text('invoiceItem[name][]',null,['id'=>'invoiceItem[name][]','class'=>'form-control current_product','placeholder'=>__('accounts.general.product_name'), 'onkeypress'=>'applySearchingOnItems(this);', 'autocomplete'=>'off', 'required']) !!}
                        {!! Form::hidden('invoiceItem[id][]', null,['id'=>'invoiceItem[id][]','class'=>'current_id', 'required']) !!}
                    </td>
                    <td>
                        {!!  Form::text('invoiceItem[desc][]',null,['id'=>'invoiceItem[desc][]','class'=>'form-control']) !!}
                    </td>
                    <td>
                        {!!  Form::text('invoiceItem[available][]',null,['id'=>'invoiceItem[available][]','class'=>'form-control text-right current_qty_available','placeholder'=>'0.00','readonly'=>'', 'tabindex'=>'-1']) !!}
                    </td>
                    <td>
                        {!!  Form::number('invoiceItem[qty][]',null,['step'=>'any','min'=>'1','id'=>'invoiceItem[qty][]','class'=>'form-control text-right current_quantity','placeholder'=>'0','onkeyup'=>'applyRowCalculation(this);','onchange'=>'applyRowCalculation(this);', 'required', 'autocomplete'=>'off']) !!}
                    </td>
                    <td>
                        {!!  Form::number('invoiceItem[rate][]',null,['step'=>'any','min'=>'1','id'=>'invoiceItem[rate][]','class'=>'form-control text-right current_price','placeholder'=>'0.00','onkeyup'=>'applyRowCalculation(this);','onchange'=>'applyRowCalculation(this);', 'required', 'autocomplete'=>'off']) !!}
                        {!!  Form::hidden('invoiceItem[supplier_rate][]',null,['id'=>'invoiceItem[supplier_rate][]', 'class' =>'current_supplier_price']) !!}
                    </td>
                    <td>
                        {!!  Form::number('invoiceItem[tax][]',null,['step'=>'any','min'=>'0','id'=>'invoiceItem[tax][]','class'=>'form-control text-right current_tax','placeholder'=>'0.00','onkeyup'=>'applyRowCalculation(this);','onchange'=>'applyRowCalculation(this);', 'autocomplete'=>'off']) !!}
                        {!!  Form::hidden('invoiceItem[tax_amount][]', null,['id'=>'invoiceItem[tax_amount][]','class'=>'current_tax_amount']) !!}
                    </td>
                    <td>
                        {!!  Form::number('invoiceItem[discount][]',null,['step'=>'any','min'=>'0','id'=>'invoiceItem[discount][]','class'=>'form-control text-right current_discount','placeholder'=>'0.00','onkeyup'=>'applyRowCalculation(this);','onchange'=>'applyRowCalculation(this);', 'autocomplete'=>'off']) !!}
                        {!!  Form::hidden('invoiceItem[discount_amount][]', null,['class'=>'current_discount_amount']) !!}
                    </td>
                    <td>
                        {!!  Form::text('invoiceItem[total][]',null ,['id'=>'invoiceItem[total][]','class'=>'form-control text-right current_total','placeholder'=>'0.00','readonly', 'tabindex'=>'-1', 'required']) !!}
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
    </div>
</div>
