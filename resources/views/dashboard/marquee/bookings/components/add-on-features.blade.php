<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center product_field" style="width: 15%;">Addon Service</th>
            <th class="text-center" style="width: 12%;">Qty.</th>
            <th class="text-center" style="width: 12%;">No. of Hour</th>
            <th class="text-center" style="width: 12%;">Price</th>
            <th class="text-center" style="width: 12%;">Total</th>
            <th class="text-center" style="width: 15%;">Details</th>
            <th class="text-center" style="width: 12%;">Action</th>
        </tr>
    </thead>
    <tbody id="addon_items_body">
    @if(isset($for))



        @if(count($model->addOnFeatures))
            @foreach($model->addOnFeatures as $addOnFeature)
                <tr>
                    <td>
                        {!! Form::hidden('addOnFeatures[id][]',$addOnFeature->id,['class'=>'current_id']) !!}
                        {!! Form::text('addOnFeatures[name][]',$addOnFeature->name,['id'=>'addOnFeatures[name][]','class'=>'form-control current_product add_on_feature_name','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingForAddOn(this);', 'autocomplete'=>'off']) !!}
                    </td>
                    <td>
                        {!!  Form::number('addOnFeatures[quantity][]',$addOnFeature->pivot->quantity,['min'=>'0','id'=>'addOnFeatures[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyAddonPrice(this);','onchange'=>"applyAddonPrice(this);"]) !!}
                    </td>
                    <td>
                        {!!  Form::number('addOnFeatures[hourly][]',$addOnFeature->pivot->hourly,['min'=>'0','id'=>'addOnFeatures[hourly][]','class'=>'form-control  current_hourly','placeholder'=>'0','onkeyup'=>'applyAddonPrice(this);','onchange'=>"applyAddonPrice(this);"]) !!}
                    </td>
                    <td>
                        {!!  Form::number('addOnFeatures[price][]',$addOnFeature->pivot->price,['min'=>'0','id'=>'addOnFeatures[price][]','class'=>'form-control  current_price','placeholder'=>'0.00','onkeyup'=>'applyAddonPrice(this);','onchange'=>"applyAddonPrice(this);"]) !!}
                    </td>
                    <td>
                        {!!  Form::text('addOnFeatures[total][]',$addOnFeature->pivot->total,['id'=>'addOnFeatures[total][]','class'=>'form-control  current_total','placeholder'=>'0.00','readonly','tabindex' => '-1']) !!}
                    </td>
                    <td>
                        {!!  Form::text('addOnFeatures[details][]',$addOnFeature->pivot->details,['id'=>'addOnFeatures[details][]','class'=>'form-control  current_detail','placeholder'=>'']) !!}
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
                    {!! Form::hidden('addOnFeatures[id][]',null,['class'=>'current_id']) !!}
                    {!! Form::text('addOnFeatures[name][]',null,['id'=>'addOnFeatures[name][]','class'=>'form-control current_product add_on_feature_name','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingForAddOn(this);', 'autocomplete'=>'off']) !!}
                </td>
                <td>
                    {!!  Form::number('addOnFeatures[quantity][]',null,['min'=>'0','id'=>'addOnFeatures[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyAddonPrice(this);','onchange'=>"applyAddonPrice(this);"]) !!}
                </td>
                <td>
                    {!!  Form::number('addOnFeatures[hourly][]',null,['min'=>'0','id'=>'addOnFeatures[hourly][]','class'=>'form-control  current_hourly','placeholder'=>'0','onkeyup'=>'applyAddonPrice(this);','onchange'=>"applyAddonPrice(this);"]) !!}
                </td>
                <td>
                    {!!  Form::number('addOnFeatures[price][]',null,['min'=>'0','id'=>'addOnFeatures[price][]','class'=>'form-control  current_price','placeholder'=>'0.00','onkeyup'=>'applyAddonPrice(this);','onchange'=>"applyAddonPrice(this);"]) !!}
                </td>
                <td>
                    {!!  Form::text('addOnFeatures[total][]',null,['id'=>'addOnFeatures[total][]','class'=>'form-control  current_total','placeholder'=>'0.00','readonly','tabindex' => '-1']) !!}
                </td>
                <td>
                    {!!  Form::text('addOnFeatures[details][]',null,['id'=>'addOnFeatures[details][]','class'=>'form-control  current_detail','placeholder'=>'']) !!}
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
                {!! Form::hidden('addOnFeatures[id][]',null,['class'=>'current_id']) !!}
                {!! Form::text('addOnFeatures[name][]',null,['id'=>'addOnFeatures[name][]','class'=>'form-control current_product add_on_feature_name','placeholder'=>'Search Name', 'onkeypress'=>'applySearchingForAddOn(this);', 'autocomplete'=>'off']) !!}
            </td>
            <td>
                {!!  Form::number('addOnFeatures[quantity][]',null,['min'=>'0','id'=>'addOnFeatures[quantity][]','class'=>'form-control  current_quantity','placeholder'=>'','onkeyup'=>'applyAddonPrice(this);','onchange'=>"applyAddonPrice(this);"]) !!}
            </td>
            <td>
                {!!  Form::number('addOnFeatures[hourly][]',null,['min'=>'0','id'=>'addOnFeatures[hourly][]','class'=>'form-control  current_hourly','placeholder'=>'0','onkeyup'=>'applyAddonPrice(this);','onchange'=>"applyAddonPrice(this);"]) !!}
            </td>
            <td>
                {!!  Form::number('addOnFeatures[price][]',null,['min'=>'0','id'=>'addOnFeatures[price][]','class'=>'form-control  current_price','placeholder'=>'0.00','onkeyup'=>'applyAddonPrice(this);','onchange'=>"applyAddonPrice(this);"]) !!}
            </td>
            <td>
                {!!  Form::text('addOnFeatures[total][]',null,['id'=>'addOnFeatures[total][]','class'=>'form-control  current_total','placeholder'=>'0.00','readonly','tabindex' => '-1']) !!}
            </td>
            <td>
                {!!  Form::text('addOnFeatures[details][]',null,['id'=>'addOnFeatures[details][]','class'=>'form-control  current_detail','placeholder'=>'']) !!}
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
