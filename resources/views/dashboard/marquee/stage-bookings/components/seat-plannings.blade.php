<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th class="text-center product_field">Information
        </th>
        <th class="text-center">Pexs
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
        @if(count($model->seatPlannings)>0)
            @foreach($model->seatPlannings as $seatPlanning)
                <tr>
                    <td>
                        {!! Form::hidden('seatPlannings[id][]',$seatPlanning->id,['class'=>'current_id']) !!}
                        {!! Form::text('seatPlannings[name][]',$seatPlanning->name,['id'=>'seatPlannings[name][]','class'=>'form-control current_product seat_planning_name','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingForSeatPlannings(this);','autocomplete'=>'off']) !!}
                    </td>
                    <td>
                        {!!  Form::number('seatPlannings[quantity][]',$seatPlanning->pivot->quantity,['step'=>'any','min'=>'0','id'=>'seatPlannings[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','onchange'=>"applyQuantity(this);"]) !!}
                    </td>

                    <td>
                        {!!  Form::number('seatPlannings[price][]',$seatPlanning->pivot->price,['step'=>'any','min'=>'0','id'=>'oodItems[price][]','class'=>'form-control  current_price','placeholder'=>'','onkeyup'=>'applyPrice(this);','onchange'=>"applyPrice(this);"]) !!}
                    </td>
                    <td>
                        {!!  Form::number('seatPlannings[discount][]',$seatPlanning->pivot->discount,['step'=>'any','min'=>'0','id'=>'seatPlannings[discount][]','class'=>'form-control  current_discount','placeholder'=>'','onkeyup'=>'applyDiscount(this);','onchange'=>"applyDiscount(this);"]) !!}
                    </td>
                    <td>
                        {!!  Form::number('seatPlannings[total][]',$seatPlanning->pivot->total,['step'=>'any','min'=>'0','id'=>'oodItems[total][]','class'=>'form-control  current_total','placeholder'=>'','readonly','oninput'=>"this.value = Math.abs(this.value)",'tabindex' => '-1']) !!}
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
            @endforeach
        @else
            <tr>
                <td>
                    {!! Form::hidden('seatPlannings[id][]',null,['class'=>'current_id']) !!}
                    {!! Form::text('seatPlannings[name][]',null,['id'=>'seatPlannings[name][]','class'=>'form-control current_product seat_planning_name','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingForSeatPlannings(this);','autocomplete'=>'off']) !!}
                </td>
                <td>
                    {!!  Form::number('seatPlannings[quantity][]',null,['step'=>'any','min'=>'0','id'=>'seatPlannings[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','onchange'=>"applyQuantity(this);"]) !!}
                </td>

                <td>
                    {!!  Form::number('seatPlannings[price][]',null,['step'=>'any','min'=>'0','id'=>'oodItems[price][]','class'=>'form-control  current_price','placeholder'=>'','onkeyup'=>'applyPrice(this);','onchange'=>"applyPrice(this);"]) !!}
                </td>
                <td>
                    {!!  Form::number('seatPlannings[discount][]',null,['step'=>'any','min'=>'0','id'=>'seatPlannings[discount][]','class'=>'form-control  current_discount','placeholder'=>'','onkeyup'=>'applyDiscount(this);','onchange'=>"applyDiscount(this);"]) !!}
                </td>
                <td>
                    {!!  Form::number('seatPlannings[total][]',null,['step'=>'any','min'=>'0','id'=>'oodItems[total][]','class'=>'form-control  current_total','placeholder'=>'','readonly','oninput'=>"this.value = Math.abs(this.value)",'tabindex' => '-1']) !!}
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
        @endif
    @else
        <tr>
            <td>
                {!! Form::hidden('seatPlannings[id][]',null,['class'=>'current_id']) !!}
                {!! Form::text('seatPlannings[name][]',null,['id'=>'seatPlannings[name][]','class'=>'form-control current_product seat_planning_name','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingForSeatPlannings(this);','autocomplete'=>'off']) !!}
            </td>
            <td>
                {!!  Form::number('seatPlannings[quantity][]',null,['step'=>'any','min'=>'0','id'=>'seatPlannings[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','onchange'=>"applyQuantity(this);"]) !!}
            </td>

            <td>
                {!!  Form::number('seatPlannings[price][]',null,['step'=>'any','min'=>'0','id'=>'oodItems[price][]','class'=>'form-control  current_price','placeholder'=>'','onkeyup'=>'applyPrice(this);','onchange'=>"applyPrice(this);"]) !!}
            </td>
            <td>
                {!!  Form::number('seatPlannings[discount][]',null,['step'=>'any','min'=>'0','id'=>'seatPlannings[discount][]','class'=>'form-control  current_discount','placeholder'=>'','onkeyup'=>'applyDiscount(this);','onchange'=>"applyDiscount(this);"]) !!}
            </td>
            <td>
                {!!  Form::number('seatPlannings[total][]',null,['step'=>'any','min'=>'0','id'=>'oodItems[total][]','class'=>'form-control  current_total','placeholder'=>'','readonly','oninput'=>"this.value = Math.abs(this.value)",'tabindex' => '-1']) !!}
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
    @endif
    </tbody>
</table>
