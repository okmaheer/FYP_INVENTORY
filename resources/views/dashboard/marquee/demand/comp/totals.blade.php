<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover" id="normalinvoice">
                    <tfoot>
                    <tr>
                        <td colspan="4">
                            <b>Total Discount:</b>
                            {!! Form::text('discount_total',null,['id'=>'discount_total','class'=>'form-control text-right','placeholder'=>'0.00','readonly']) !!}
                        </td>
                        <td colspan="4">
                            <b>Misc Cost:</b>
                            {!! Form::text('misc_cost_total',null,['id'=>'misc_cost_total','class'=>'form-control text-right','placeholder'=>'0.00']) !!}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <b>Grand Total:</b>
                            {!! Form::text('grand_total',null,['id'=>'grand_total','class'=>'form-control text-right','placeholder'=>'0.00','readonly']) !!}
                        </td>
                        <td colspan="4">
                            <b>Paid Amount:</b>
                            {!! Form::text('total_paid_amount',null,['id'=>'total_paid_amount','class'=>'form-control text-right','placeholder'=>'0.00']) !!}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <b>Previous:</b>
                            {!! Form::text('total_previous_amount',null,['id'=>'total_previous_amount','class'=>'form-control text-right','placeholder'=>'0.00','readonly']) !!}
                        </td>
                        <td colspan="4">
                            <b>Due:</b>
                            {!! Form::text('total_dues_amount',null,['id'=>'total_dues_amount','class'=>'form-control text-right','placeholder'=>'0.00','readonly']) !!}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <b>Net Total: </b>
                            {!! Form::text('net_total',null,['id'=>'net_total','class'=>'form-control text-right','placeholder'=>'0.00','readonly']) !!}
                        </td>
                        <td colspan="4">
                            <b>Change: </b>
                            {!! Form::text('total_change_amount',null,['id'=>'total_change_amount','class'=>'form-control text-right','placeholder'=>'0.00','readonly']) !!}
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
