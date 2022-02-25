

<div class="card">
    <div class="panel-title border-grey border-bottom">
        <h4 class="p-3 text-dark"> Demand Items </h4>
    </div>
    <div class="card-body">

        <div class="table-rep-plugin">
            <div class="table-responsive mb-0" data-pattern="priority-columns">
                <div class="container-fluid">



<table class="table table-bordered table-hover" id="food_items_holder">
    <thead>
    <tr>
        <th class="text-center product_field">Item Information
            <i class="text-danger">*</i>
        </th>
        <th class="text-center">Stock/Qty
            <i class="text-danger">*</i>
        </th>


        <th class="text-center">Action</th>
    </tr>
    </thead>
    <tbody id="food_items_body">
    @if(isset($for))
        @if(count($model->demand))
            @foreach($model->demand as $demand)
                <tr>
                    <td>
                        {!! Form::hidden('demand[id][]',$demand->id,['class'=>'current_id']) !!}
                        {!! Form::text('demand[name][]',$demand->product_name,['id'=>'demand[name][]','class'=>'form-control current_product current_menu_product','placeholder'=>'Demand Name', 'onkeypress'=>'applySearchingOnMenu(this);']) !!}
                    </td>
                    <td>
                        {!!  Form::number('demand[quantity][]',$demand->pivot->quantity,['min'=>'0','id'=>'demand[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','oninput'=>"this.value = Math.abs(this.value)"]) !!}
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
                    {!! Form::hidden('demand[id][]',null,['class'=>'current_id']) !!}
                    {!! Form::text('demand[name][]',null,['id'=>'demand[name][]','class'=>'form-control current_product current_menu_product','placeholder'=>'Demand Name', 'onkeypress'=>'applySearchingOnMenu(this);']) !!}
                </td>
                <td>
                    {!!  Form::number('demand[quantity][]',null,['min'=>'0','id'=>'demand[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','oninput'=>"this.value = Math.abs(this.value)"]) !!}

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
                {!! Form::hidden('demand[id][]',null,['class'=>'current_id']) !!}
                {!! Form::text('demand[name][]',null,['id'=>'demand[name][]','class'=>'form-control current_product current_menu_product','placeholder'=>'Demand Name', 'onkeypress'=>'applySearchingOnMenu(this);']) !!}
            </td>
            <td>
                {!!  Form::number('demand[quantity][]',null,['min'=>'0','id'=>'demand[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyQuantity(this);','oninput'=>"this.value = Math.abs(this.value)"]) !!}
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



                </div>

            </div>

        </div>




    </div>
</div>























