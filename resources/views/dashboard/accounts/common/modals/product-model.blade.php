<div class="modal fade" id="product_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        {!! Form::open(['route' => 'add.product.ajax', 'files' => true, 'id' => 'product_ajax_form'] ) !!}
        <div class="modal-header bg-success">
            <h5 class="modal-title mt-0 text-light" id="exampleModalLabel">Add New Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div class="form-group row">
                <div class="col-sm-4">
                    {!!  Html::decode(Form::label('modal_product_name' ,'Product Name <i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
                </div>
                <div class="col-sm-8">
                    {!!  Form::text('product_name',null,['id'=>'modal_product_name','class'=>'form-control ','placeholder'=>'Product Name','required']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                    {!!  Html::decode(Form::label('modal_category_id' ,'Category <i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
                </div>
                <div class="col-sm-8">
                    {!!  Form::select('category_id', $categories,null,['id'=>'modal_category_id',
                            'class'=>'form-control',
                            'placeholder'=>'Select Category','required','style'=> 'width : 100%;'])
                    !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                    {!!  Html::decode(Form::label('modal_unit' ,'Unit <i class="text-danger">*</i>' ,['class'=>'col-form-label']) )  !!}
                </div>
                <div class="col-sm-8">
                    {!!  Form::select('unit', $units,null,['id'=>'modal_unit',
                            'class'=>'form-control',
                            'placeholder'=>'Select Unit', 'required', 'style'=> 'width : 100%;'])
                    !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                    {!!  Form::label('modal_price' ,'Sale Price' ,['class'=>'col-form-label text-right'])   !!}
                </div>
                <div class="col-sm-8">
                    {!!  Form::number('price',null,['step'=>'any','id'=>'modal_price','class'=>'form-control','placeholder'=>'0.00']) !!}
                </div>
            </div>

        </div>
        <div class="modal-footer">
            @include('dashboard.accounts.common.buttons.buttons-crud', ['save' => true])
        </div>
        {!! Form::close() !!}
    </div>
    </div>
</div>
