<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th class="text-center product_field" style="width: 30%;">Plan Name</th>
        <th class="text-center" style="width: 20%;">No. of Persons</th>
        <th class="text-center" style="width: 35%;">Details</th>
        <th class="text-center" style="width: 15%;">Action</th>
    </tr>
    </thead>
    <tbody id="seat_items_body">
    @if(isset($for))
        @if(count($model->seatPlannings)>0)
            @foreach($model->seatPlannings as $seatPlanning)
                <tr>
                    <td>
                        {!! Form::hidden('seatPlannings[id][]',$seatPlanning->id,['class'=>'current_id']) !!}
                        {!! Form::text('seatPlannings[name][]',$seatPlanning->name,['id'=>'seatPlannings[name][]','class'=>'form-control current_product seat_planning_name','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingForSeatPlannings(this);', 'autocomplete' => 'off']) !!}
                    </td>
                    <td>
                        {!!  Form::number('seatPlannings[quantity][]',$seatPlanning->pivot->quantity,['min'=>'0','id'=>'seatPlannings[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','onchange'=>"applyQuantity(this);"]) !!}
                    </td>
                    <td>
                        {!!  Form::text('seatPlannings[details][]',$seatPlanning->pivot->details,['id'=>'seatPlannings[details][]','class'=>'form-control  current_detail','placeholder'=>'']) !!}
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
                    {!! Form::hidden('seatPlannings[id][]',null,['class'=>'current_id']) !!}
                    {!! Form::text('seatPlannings[name][]',null,['id'=>'seatPlannings[name][]','class'=>'form-control current_product seat_planning_name','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingForSeatPlannings(this);','autocomplete'=>'off']) !!}
                </td>
                <td>
                    {!!  Form::number('seatPlannings[quantity][]',null,['min'=>'0','id'=>'seatPlannings[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','onchange'=>"applyQuantity(this);"]) !!}
                </td>
                <td>
                    {!!  Form::text('seatPlannings[details][]',null,['id'=>'seatPlannings[details][]','class'=>'form-control  current_detail','placeholder'=>'']) !!}
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
                {!! Form::hidden('seatPlannings[id][]',null,['class'=>'current_id']) !!}
                {!! Form::text('seatPlannings[name][]',null,['id'=>'seatPlannings[name][]','class'=>'form-control current_product seat_planning_name','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingForSeatPlannings(this);','autocomplete'=>'off']) !!}
            </td>
            <td>
                {!!  Form::number('seatPlannings[quantity][]',null,['min'=>'0','id'=>'seatPlannings[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','onchange'=>"applyQuantity(this);"]) !!}
            </td>
            <td>
                {!!  Form::text('seatPlannings[details][]',null,['id'=>'seatPlannings[details][]','class'=>'form-control  current_detail','placeholder'=>'']) !!}
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
