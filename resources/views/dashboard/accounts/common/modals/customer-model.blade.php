<div id="customer_add_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'add.customer.ajax', 'files' => true, 'id' => 'customer_ajax_form'] ) !!}
            <div class="modal-header bg-success">
                <h5 class="modal-title mt-0 text-light" id="myModalLabel">Add New Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <div class="form-group row">
                    <div class="col-sm-4">
                        {!!  Html::decode(Form::label('modal_customer_name' ,__('accounts.customers.name') . '<i class="text-danger">*</i>',['class'=>'col-form-label text-right']))   !!}
                    </div>
                    <div class="col-sm-8">
                        {!!  Form::text('customer_name',null,['id'=>'modal_customer_name','class'=>'form-control ','placeholder'=>'Customer Name', 'required']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        {!!  Html::decode(Form::label('modal_customer_cnic' ,__('accounts.general.cnic') ,['class'=>'col-form-label text-right']))   !!}
                    </div>
                    <div class="col-sm-8">
                        {!!  Form::text('cnic',null,['id'=>'modal_customer_cnic','class'=>'form-control ','placeholder'=>'Customer CNIC']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        {!!  Html::decode(Form::label('modal_customer_mobile' ,__('accounts.customers.mobile') . '<i class="text-danger">*</i>',['class'=>'col-form-label text-right']))   !!}
                    </div>
                    <div class="col-sm-8">
                        {!!  Form::number('customer_mobile',null,['id'=>'modal_customer_mobile','class'=>'form-control ','placeholder'=>'Mobile No', 'required']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        {!!  Html::decode(Form::label('modal_customer_phone' ,__('accounts.customers.phone') ,['class'=>'col-form-label text-right']))   !!}
                    </div>
                    <div class="col-sm-8">
                        {!!  Form::number('phone',null,['id'=>'modal_customer_phone','class'=>'form-control ','placeholder'=>'Phone']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        {!!  Html::decode(Form::label('modal_customer_address' ,__('accounts.general.address') ,['class'=>'col-form-label text-right']))   !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::textarea('customer_address',null,['class' => 'form-control','id' => 'modal_customer_address', 'size' => '20x2','placeholder'=>'Address']) !!}
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
