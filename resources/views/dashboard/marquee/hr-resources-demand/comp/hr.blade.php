<div class="table-rep-plugin">
    <div class="table-responsive mb-0" data-pattern="priority-columns">
        <div class="container-fluid">


            <table class="table table-bordered table-hover" id="food_items_holder">
                <thead>
                <tr>
                    <th class="text-center product_field">HR Type</th>
                    <th class="text-center">HR Name</th>
                    <th class="text-center">Shift</th>
                    <th class="text-center">Timing</th>
                    <th class="text-center">Wage per shift</th>
                    <th class="text-center">Total</th>
                    <th class="text-center col-2">Action</th>
                </tr>
                </thead>
                <tbody id="food_items_body">
                @if(isset($for))
                    @if(count($model->demandHrDetails))
                        @foreach($model->demandHrDetails as $demandHrDetail)
                            <tr>
                                <td class="text-center">
                                    {!!  Form::select('hrDemand[designation_id][]', $designation ,$demandHrDetail->designation->id,[
                                                                    'class'=>'select2 form-control mb-3 custom-select float-right designation_id',
                                                                    'placeholder'=>'Select Designation/Option','required',
                                                                    'style'=>'width:200px;'])
                                                                  !!}
                                </td>
                                <td>
                                    {!!  Form::select('hrDemand[employee_id][]', $employee,$demandHrDetail->employee->id,[
                                                                    'class'=>'select2 form-control mb-3 custom-select float-right employee_id',
                                                                    'placeholder'=>'Select Employee/Option','required',
                                                                    'style'=>'width:200px;'])
                                                                  !!}
                                </td>
                                <td>
                                    {!!  Form::text('hrDemand[shift][]',$demandHrDetail->shift,['id'=>'shift','class'=>'form-control ','placeholder'=>'']) !!}
                                </td>
                                <td>
                                    {!!  Form::text('hrDemand[timing][]',$demandHrDetail->timing,['id'=>'timing','class'=>'form-control ','placeholder'=>'']) !!}
                                </td>
                                <td>
                                    {!!  Form::text('hrDemand[wages][]',$demandHrDetail->wage,['id'=>'wages','class'=>'form-control ','placeholder'=>'']) !!}
                                </td>
                                <td>
                                    {!!  Form::text('hrDemand[total][]',$demandHrDetail->total,['id'=>'wages','class'=>'form-control ','placeholder'=>'']) !!}
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
                            {!!  Form::select('hrDemand[designation_id][]', $designation,null,[
                                                            'class'=>'select2 form-control mb-3 custom-select float-right designation_id',
                                                            'placeholder'=>'Select Designation/Option','required',
                                                            'style'=>'width:200px;'])
                                                          !!}
                        </td>
                        <td>
                            {!!  Form::select('hrDemand[employee_id][]', $employee,null,[
                                                            'class'=>'select2 form-control mb-3 custom-select float-right employee_id',
                                                            'placeholder'=>'Select Employee/Option','required',
                                                            'style'=>'width:200px;'])
                                                          !!}
                        </td>
                        <td>
                            {!!  Form::text('hrDemand[shift][]',null,['id'=>'shift','class'=>'form-control ','placeholder'=>'']) !!}
                        </td>
                        <td>
                            {!!  Form::text('hrDemand[timing][]',null,['id'=>'timing','class'=>'form-control ','placeholder'=>'']) !!}
                        </td>
                        <td>
                            {!!  Form::text('hrDemand[wages][]',null,['id'=>'wages','class'=>'form-control ','placeholder'=>'']) !!}
                        </td>
                        <td>
                            {!!  Form::text('hrDemand[total][]',null,['id'=>'wages','class'=>'form-control ','placeholder'=>'']) !!}
                        </td>
                        <td class="text-center">
                            <a href="javascript:void();"
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
