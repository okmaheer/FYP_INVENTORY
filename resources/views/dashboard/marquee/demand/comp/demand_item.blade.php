<div class="card">
    <div class="panel-title border-grey border-bottom">
        <h4 class="p-3 text-dark"> Demand Items </h4>
    </div>
    <div class="card-body">

        <div class="table-rep-plugin">
            <div class="table-responsive mb-0" data-pattern="priority-columns">
                <div class="container-fluid">


                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">


                        <thead>
                            <tr>
                                <td>SL.</td>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>

                        </thead>
                        <tbody>



                        @forelse($category->products as $key => $data)
                                <tr>
                                    <td>
                                        {{$key+1}}
                                    </td>
                                    <td>
                                        {{$data->product_name}}
                                        {!! Form::hidden('product_id['.$data->id.'][]',$data->id) !!}
                                        {!! Form::checkbox('mark_product['.$data->id.'][]',1,null,['class'=>'float-right']) !!}
                                    </td>
                                    <td>{!! Form::number('quantity['.$data->id.'][]',null,['class'=>'form-control']) !!}</td>
                                    <td>{!! Form::number('price['.$data->id.'][]',$data->price,['class'=>'form-control']) !!}</td>

                                </tr>

                        @empty
                        @endforelse

                        </tbody>



                    </table>



                </div>

            </div>

        </div>




    </div>
</div>