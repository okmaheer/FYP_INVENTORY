

<div class="card">
    <div class="panel-title border-grey border-bottom">
        <h4 class="p-3 text-dark"> Menu Details</h4>
    </div>
    <div class="card-body">

        <div class="table-rep-plugin">
            <div class="table-responsive mb-0" data-pattern="priority-columns">
                <div class="container-fluid">



<table class="table table-bordered border-dark" id="food_items_holder">
    <thead>
    <tr>
        <th class="text-center product_field">Item Name</th>
        <th class="text-center">Ingredients</th>
        <th class="text-center">Per Unit Value</th>
        <th class="text-center">Required</th>
        <th class="text-center">Available at Kitchen</th>
        <th class="text-center">To Be Purchased</th>
        <th class="text-center">Action</th>
    </tr>
</thead>
<tbody id="food_items_body table-bordered">
                <tr>
                    <td class="text-center" rowspan="1000">
                        <div class="input-group">
                            {!! Form::hidden('id',null,['class'=>'']) !!}
                        {!! Form::text('name',null,['id'=>'name','class'=>'form-control','placeholder'=>'', 'autocomplete' => 'off']) !!}
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>

                        Check if you want to consume kitchen stock. <br>
                        {!! Form::checkbox('checkbox', 0 ,null,['id'=>'checkbox','class'=>'checkbox-success','placeholder'=>'']) !!}

                    </td>
                </tr>
                <tr>
                    <td>
                        {!!  Form::text('ingredients',null,['id'=>'ingredients','class'=>'form-control','placeholder'=>'', 'autocomplete'=>'off']) !!}

                    </td>
                    <td>
                        {!!  Form::number('per_unit_value',null,['step'=>'any','min'=>'0','id'=>'per_unit_value','class'=>'form-control ','placeholder'=>'']) !!}
                    </td>
                    <td>
                        {!!  Form::number('required',null,['step'=>'any','min'=>'0','id'=>'required','class'=>'form-control ','placeholder'=>'']) !!}
                    </td>
                    <td>
                        {!!  Form::number('available',null,['step'=>'any','min'=>'0','id'=>'available','class'=>'form-control ','placeholder'=>'']) !!}

                    </td>
                    <td>
                        {!!  Form::number('purchaseable',null,['step'=>'any','min'=>'0','id'=>'purchaseable','class'=>'form-control ','placeholder'=>'']) !!}

                    </td>
                    <td class="text-center" style="height: 100%">
                        <a href="javascript:void(0);"
                           onclick="removeClonedRow(this);"
                           class="btn btn-xs btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                        <a href="javascript:void(0);"
                           onclick="cloneRow(this);"
                           class="btn btn-xs btn-info">
                            <i class="fas fa-plus"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        {!!  Form::text('ingredients',null,['id'=>'ingredients','class'=>'form-control','placeholder'=>'']) !!}

                    </td>
                    <td>
                        {!!  Form::number('per_unit_value',null,['id'=>'per_unit_value','class'=>'form-control ','placeholder'=>'']) !!}
                    </td>
                    <td>
                        {!!  Form::number('required',null,['id'=>'required','class'=>'form-control ','placeholder'=>'']) !!}
                    </td>
                    <td>
                        {!!  Form::number('available',null,['id'=>'available','class'=>'form-control ','placeholder'=>'']) !!}

                    </td>
                    <td>
                        {!!  Form::number('purchaseable',null,['id'=>'purchaseable','class'=>'form-control ','placeholder'=>'']) !!}

                    </td>
                    <td class="text-center" style="height: 100%">
                        <a href="javascript:void(0);"
                           onclick="removeClonedRow(this);"
                           class="btn btn-xs btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                        <a href="javascript:void(0);"
                           onclick="cloneRow(this);"
                           class="btn btn-xs btn-info">
                            <i class="fas fa-plus"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        {!!  Form::text('ingredients',null,['id'=>'ingredients','class'=>'form-control','placeholder'=>'']) !!}

                    </td>
                    <td>
                        {!!  Form::number('per_unit_value',null,['id'=>'per_unit_value','class'=>'form-control ','placeholder'=>'']) !!}
                    </td>
                    <td>
                        {!!  Form::number('required',null,['id'=>'required','class'=>'form-control ','placeholder'=>'']) !!}
                    </td>
                    <td>
                        {!!  Form::number('available',null,['id'=>'available','class'=>'form-control ','placeholder'=>'']) !!}

                    </td>
                    <td>
                        {!!  Form::number('purchaseable',null,['id'=>'purchaseable','class'=>'form-control ','placeholder'=>'']) !!}

                    </td>
                    <td class="text-center" style="height: 100%">
                        <a href="javascript:void(0);"
                           onclick="removeClonedRow(this);"
                           class="btn btn-xs btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                        <a href="javascript:void(0);"
                           onclick="cloneRow(this);"
                           class="btn btn-xs btn-info">
                            <i class="fas fa-plus"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        {!!  Form::text('ingredients',null,['id'=>'ingredients','class'=>'form-control','placeholder'=>'']) !!}

                    </td>
                    <td>
                        {!!  Form::number('per_unit_value',null,['id'=>'per_unit_value','class'=>'form-control ','placeholder'=>'']) !!}
                    </td>
                    <td>
                        {!!  Form::number('required',null,['id'=>'required','class'=>'form-control ','placeholder'=>'']) !!}
                    </td>
                    <td>
                        {!!  Form::number('available',null,['id'=>'available','class'=>'form-control ','placeholder'=>'']) !!}

                    </td>
                    <td>
                        {!!  Form::number('purchaseable',null,['id'=>'purchaseable','class'=>'form-control ','placeholder'=>'']) !!}

                    </td>
                    <td class="text-center" style="height: 100%">
                        <a href="javascript:void(0);"
                           onclick="removeClonedRow(this);"
                           class="btn btn-xs btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                        <a href="javascript:void(0);"
                           onclick="cloneRow(this);"
                           class="btn btn-xs btn-info">
                            <i class="fas fa-plus"></i>
                        </a>
                    </td>
                </tr>
    </tbody>
</table>

                </div>

            </div>

        </div>

    </div>
</div>
