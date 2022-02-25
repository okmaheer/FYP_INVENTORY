<div class="table-rep-plugin">
    <div class="table-responsive mb-0" data-pattern="priority-columns">
        <div class="container-fluid">


            <table class="table table-bordered table-hover" id="food_items_holder">
                <thead>
                <tr>
                    <th class="text-center product_field">Item Name</th>
                    <th class="text-center">Type</th>
                    <th class="text-center">Qty. req</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center col-2">Action</th>
                </tr>
                </thead>
                <tbody id="food_items_body">
                @if(isset($for))
                    @if(count($model->demandDetails))
                        @foreach($model->demandDetails as $demandDetail)
                            <tr>

                                <td class="text-center">
                                    {!! Form::hidden('addonResource[id][]',$demandDetail->product_id,['class'=>'current_id']) !!}
                                    {!! Form::text('addonResource[name][]',$demandDetail->product->product_name,['id'=>'demand[name][]','class'=>'form-control current_product current_menu_product','placeholder'=>'Demand Name', 'onkeypress'=>'applySearchingOnMenu(this);']) !!}

                                </td>
                                <td>
                                    {!!  Form::text('addonResource[ingredients][]',$demandDetail->ingredients,['id'=>'ingredients','class'=>'form-control ','placeholder'=>'']) !!}
                                </td>
                                <td>
                                    {!!  Form::text('addonResource[quantity][]',$demandDetail->quantity,['id'=>'per_unit_value','class'=>'form-control ','placeholder'=>'']) !!}
                                </td>
                                <td>
                                    {!!  Form::text('addonResource[price][]',$demandDetail->price,['id'=>'required','class'=>'form-control ','placeholder'=>'']) !!}
                                </td>
                                <td>
                                    {!!  Form::text('addonResource[total][]',$demandDetail->total,['id'=>'available','class'=>'form-control ','placeholder'=>'']) !!}
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(this);"
                                       onclick="removeClonedRow(this);"
                                       class="btn btn-xs btn-danger">
                                        <i class="fas fa-times-circle"></i>
                                    </a>
                                    <a href="javascript:void(this);"
                                       onclick="cloneRow(this);"
                                       class="btn btn-xs btn-info">
                                        <i class="fas fa-plus-circle"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @else
                    <tr>

                        <td class="text-center">
                            {!! Form::hidden('addonResource[id][]',null,['class'=>'current_id']) !!}
                            {!! Form::text('addonResource[name][]',null,['id'=>'demand[name][]','class'=>'form-control current_product current_menu_product','placeholder'=>'Demand Name', 'onkeypress'=>'applySearchingOnMenu(this);']) !!}

                        </td>
                        <td>
                            {!!  Form::text('addonResource[ingredients][]',null,['id'=>'ingredients','class'=>'form-control ','placeholder'=>'']) !!}
                        </td>
                        <td>
                            {!!  Form::text('addonResource[quantity][]',null,['id'=>'per_unit_value','class'=>'form-control ','placeholder'=>'']) !!}
                        </td>
                        <td>
                            {!!  Form::text('addonResource[price][]',null,['id'=>'required','class'=>'form-control ','placeholder'=>'']) !!}
                        </td>
                        <td>
                            {!!  Form::text('addonResource[total][]',null,['id'=>'available','class'=>'form-control ','placeholder'=>'']) !!}
                        </td>
                        <td class="text-center">
                            <a href="javascript:void(this);"
                               onclick="removeClonedRow(this);"
                               class="btn btn-xs btn-danger">
                                <i class="fas fa-times-circle"></i>
                            </a>
                            <a href="javascript:void(this);"
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

</div>
