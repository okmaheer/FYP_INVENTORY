<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless" id="normalinvoice">
                            <tbody>
                                <tr class="d-flex">
                                    <td class="text-right col-6">
                                        <b>Grand Total:</b>
                                    </td>
                                    <td class="col-6">
                                        {!! Form::text('grand_total',null,['id'=>'grand_total','class'=>'form-control text-right','placeholder'=>'0.00','readonly']) !!}
                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <td class="text-right col-6">
                                        <b>Net Total:</b>
                                    </td>
                                    <td class="col-6">
                                        {!! Form::text('net_total',null,['id'=>'net_total','class'=>'form-control text-right','placeholder'=>'0.00','readonly']) !!}
                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <td class="text-right col-6">
                                        <b>Total Discount:</b>
                                    </td>
                                    <td class="col-6">
                                        {!! Form::text('discount_total','0.00',['id'=>'discount_total','class'=>'form-control text-right','placeholder'=>'0.00','readonly']) !!}
                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <td class="text-right col-6">
                                        <b>Overall Discount:</b>
                                    </td>
                                    <td class="col-6">
                                        {!! Form::text('misc_discount_total','0.00',['id'=>'misc_discount_total','class'=>'form-control text-right','placeholder'=>'0.00' ,'autocomplete'=>'off','onkeyup'=>'applyCalculations(this);']) !!}
                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <td class="text-right col-6">
                                        <b>Paid Amount:</b>
                                    </td>
                                    <td class="col-6">
                                        {!! Form::text('total_paid_amount','0.00',['id'=>'total_paid_amount','class'=>'form-control text-right','placeholder'=>'0.00','onkeyup'=>'applyCalculations(this);','oninput'=>"this.value = Math.abs(this.value)",'autocomplete'=>'off']) !!}
                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <td class="text-right col-6">
                                        <b>Previous:</b>
                                    </td>
                                    <td class="col-6">
                                        {!! Form::text('total_previous_amount','0.00',['id'=>'total_previous_amount','class'=>'form-control text-right','placeholder'=>'0.00','readonly']) !!}
                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <td class="text-right col-6">
                                        <b>Due:</b>
                                    </td>
                                    <td class="col-6">
                                        {!! Form::text('total_dues_amount','0.00',['id'=>'total_dues_amount','class'=>'form-control text-right','placeholder'=>'0.00','readonly']) !!}
                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <td class="text-right col-6">
                                        <b>Change:</b>
                                    </td>
                                    <td class="col-6">
                                        {!! Form::text('total_change_amount','0.00',['id'=>'total_change_amount','class'=>'form-control text-right','placeholder'=>'0.00','readonly']) !!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
