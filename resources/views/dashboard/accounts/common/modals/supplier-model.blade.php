<div id="supplier_add_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'add.supplier.ajax', 'files' => true, 'id' => 'supplier_ajax_form'] ) !!}
            <div class="modal-header bg-success">
                <h5 class="modal-title mt-0 text-light" id="myModalLabel">Add New Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-4">
                        {!! Html::decode(Form::label('modal_supplier_name' ,__('accounts.customers.name') . '<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
                    </div>
                    <div class="col-sm-8">
                        {!!  Form::text('supplier_name',null,['id'=>'modal_supplier_name','class'=>'form-control ','placeholder'=>'Supplier Name', 'required']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        {!!  Html::decode(Form::label('modal_supplier_cnic' ,__('accounts.general.cnic') . '<i class="text-danger">*</i>',['class'=>'col-form-label text-right']))   !!}
                    </div>
                    <div class="col-sm-8">
                        {!!  Form::text('cnic',null,['id'=>'modal_supplier_cnic','class'=>'form-control ','placeholder'=>'Supplier CNIC', 'required']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        {!! Html::decode(Form::label('modal_supplier_mobile' ,__('accounts.customers.mobile') . '<i class="text-danger">*</i>',['class'=>'col-form-label text-right']))   !!}
                    </div>
                    <div class="col-sm-8">
                        {!!  Form::text('supplier_mobile',null,['id'=>'modal_supplier_mobile','class'=>'form-control ','placeholder'=>'Mobile No', 'required']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        {!! Html::decode(Form::label('modal_supplier_phone' ,__('accounts.customers.phone') ,['class'=>'col-form-label text-right']))   !!}
                    </div>
                    <div class="col-sm-8">
                        {!!  Form::text('phone',null,['id'=>'modal_supplier_phone','class'=>'form-control ','placeholder'=>'Phone']) !!}
                    </div>
                </div>
                <div class="form-group row">
                        <div class="col-sm-4">
                            {!!  Html::decode(Form::label('modal_supplier_address' ,__('accounts.general.address') ,['class'=>'col-form-label text-right']))   !!}
                        </div>
                        <div class="col-sm-8">
                            {!! Form::textarea('supplier_address',null,['class' => 'form-control','id' => 'modal_supplier_address', 'size' => '20x2','placeholder'=>'Address']) !!}
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
