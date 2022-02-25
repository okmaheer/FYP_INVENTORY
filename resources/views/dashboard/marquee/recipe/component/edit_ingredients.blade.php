<table class="table table-bordered table-hover">
    <thead>
    <tr style="background-color :#214858;" class="text-white">
        <th class="text-center product_field">Ingredient

        </th>
        <th class="text-center">Final Quantity

        </th>
        <th class="text-center">Unit

        </th>
        <th class="text-center">Price

        </th>
        <th class="text-center">Total Amount

        </th>
        <th class="text-center">
         Action
        </th>


    </tr>
    </thead>
    <tbody id="ingrediets_item_body">

            @forelse($model->recipeDetails as $ingredient)
            <tr>
                <td>


                    {!!  Form::text('ingredient[name][]',$ingredient->product->product_name,['id'=>'ingredient_name[]','placeholder'=>'','class'=>'form-control current_product current_menu_product','onkeypress'=>'applySearchingOnIngredients(this);', 'autocomplete'=>'off']) !!}
                    {!! Form::hidden('ingredient[id][]',$ingredient->product->id,['class'=>'current_id']) !!}

                    {!! Form::hidden('sl', null,['class'=>'sl','value'=>1]) !!}
                </td>

                <td>
                    {!!  Form::number('ingredient[final_quantity][]',$ingredient->final_quantity,['step'=>'any','min'=>'0','id'=>'ingredient[final_quantity][]','class'=>'form-control current_quantity','onkeyup'=>'applyQuantity(this);','onchange'=>'applyQuantity(this);']) !!}

                </td>
                <td width="100">
                    {!!  Form::select('ingredient[unit][]', $units,$ingredient->unit,['id'=>'ingredient[unit][]',
                    'class'=>'select2 form-control custom-select text-center current_unit',
                    'placeholder'=>'Units'])
                        !!}
                </td>
              <td>   {!!  Form::number('ingredient[price][]',$ingredient->price,['step'=>'any','min'=>'0','id'=>'ingredient[price][]','class'=>'form-control current_price','onkeyup'=>'applyQuantity(this);','onchange'=>'applyQuantity(this);']) !!}</td>
              <td>   {!!  Form::text('ingredient[total_amount][]',$ingredient->total_amount,['min'=>'0','id'=>'ingredient[total_amount][]','class'=>'form-control current_total','readonly', 'tabindex'=>'-1']) !!}</td>

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
            @empty

            @endforelse



    </tbody>
</table>

<div class="row">
    <div class="col-md-9 float-right ">

    </div>
    <div class="col-md-3 float-right ">
        {!!  Form::label('recipe_cost' ,'Total Cost:' ,['class'=>'col-form-label text-right ml-5 current_product current_menu_product'])  !!}
        {!!  Form::text('recipe_cost',null,['min'=>'0','id'=>'cost','class'=>'form-control cost','readonly','tabindex'=>'-1']) !!}
    </div>
</div>
