{!! Form::open(['route' => 'payroll.paynow', 'files' => true, 'id' => 'salary_payment_form'] ) !!}
{!! Form::hidden('salary_id',null, ['id' => 'salary_id']) !!}

<div id="received_by_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Salary Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!!  Html::decode(Form::label('received_by' ,'Received By <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}
                            {!!  Form::select('received_by',$employees,null,['id'=>'received_by',
                                'class'=>'select2 form-control', 'style' => 'width:100%', 'required'])
                            !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::submit('Pay Now', ['id' => 'btn_save', 'class' => 'btn btn-success waves-effect waves-light w-md']) !!}
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
