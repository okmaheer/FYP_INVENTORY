@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
@endsection
@section('innerScript')
    <script>
        var isFor = 0;
        $(document).ready(function () {
            @if (isset($for))
                isFor = 1;
                applyCalculations();
            @else
                @if (!is_null($booking))
                    $("#withBooking").prop("checked", true);
                    $("#withoutBooking").prop("disabled", true);
                    applyLayout('withBooking');
                    //echo "searchBooking();\n";
                @endif
            @endif
        });

        function applyLayout(type) {
            if (type == 'withBooking') {
                $('div#withoutBooking').hide();
                $('div#withBooking').show();
            } else {
                $('div#withoutBooking').show();
                $('div#withBooking').hide();

            }
        }

        function SubmitAndPrint() {
            $("#doPrint").val('1');
            $("#booking_form").submit();
        }

        (function () {
            $('.select2').select2();

            //disable form to submit on enter
            $(document).on("keydown", ":input:not(textarea)", function(event) {
                if (event.key == "Enter") {
                    event.preventDefault();
                }
            });
        })();

        function cloneRow(cElement) {
            let clone = $(cElement).closest('tr').clone();
            $(clone).find('input[type=text]').val('');
            $(clone).find('input[type=number]').val('');
            $(clone).find('input[type=hidden]').val('');
            $(cElement).closest('tbody').append(clone);
            applyCalculations();
        }

        function removeClonedRow(cElement) {
            let length = $(cElement).closest('tbody').find('tr').length;
            if (length > 1) {
                $(cElement).closest('tr').remove();
            } else {
                alert("At least one row is Required")
            }
            applyCalculations();
        }

        function applySearchingForStageDecorations(cElement) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var options = {
                source: function (request, response) {
                    $.ajax({
                        type: 'GET',
                        url: "/autocomplete/stage-decorations?d=" + $(cElement).val(),
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                focus: function (event, ui) {
                    // $(this).val(ui.item.label);
                    return false;
                },
                select: function (event, ui) {
                    $(this).val(ui.item.label);
                    $(cElement).closest('tr').find('.current_id').val(ui.item.value);
                    $(cElement).closest('tr').find('.current_price').val(ui.item.extra.price);
                    applyCalculations();
                    $(this).unbind("change");
                    return false;
                }
            };
            $('body').on('keypress.autocomplete', '.stage_decoration_name', function () {
                $(this).autocomplete(options);
            });
        }

        function applyPrice(cElement) {

            let price = $(cElement).val();
            let discount = $(cElement).closest('tr').find('.current_discount').val();
            let quantity = $(cElement).closest('tr').find('.current_quantity').val();

            let final_price = quantity * price;
            //let find_discount = +(final_price * discount / 100);
            let find_discount = +(discount);
            let current_total = final_price - find_discount;
            $(cElement).closest('tr').find('.current_net_total').val(final_price.toFixed(2));
            $(cElement).closest('tr').find('.current_total').val(current_total.toFixed(2));

            applyCalculations();
        }

        function applyDiscount(cElement) {

            let discount = $(cElement).val();
            let price = $(cElement).closest('tr').find('.current_price').val();
            let quantity = $(cElement).closest('tr').find('.current_quantity').val();

            let final_price = quantity * price;
            let find_discount = +(discount);
            //let ttl_discount_unit_wise =  discount * quantity;
            let current_total = final_price - find_discount;
            $(cElement).closest('tr').find('.current_net_total').val(final_price.toFixed(2));
            $(cElement).closest('tr').find('.current_total').val(current_total.toFixed(2));

            applyCalculations();
        }

        function applyQuantity(cElement) {

            let quantity = $(cElement).val();
            let price = $(cElement).closest('tr').find('.current_price').val();
            let discount = $(cElement).closest('tr').find('.current_discount').val();

            let final_price = quantity * price;
            //let find_discount = +(final_price * discount / 100);
            let find_discount = +(discount);
            let current_total = final_price - find_discount;

            $(cElement).closest('tr').find('.current_net_total').val(final_price.toFixed(2));
            $(cElement).closest('tr').find('.current_total').val(current_total.toFixed(2));

            applyCalculations();
        }

        function applyCalculations() {
            // Misc Discount
            let miscDiscount = Number($("#misc_discount_total").val());

            // Discount Management
            let totalDiscount = 0;
            $('.current_discount').each(function () {
                let innerDiscount = Number($(this).val());
                totalDiscount += innerDiscount;
            });
            totalDiscount += miscDiscount;
            $("#discount_total").val(!isNaN(totalDiscount) ? totalDiscount.toFixed(2) : '0.00');
            if (isNaN(totalDiscount)) {
                totalDiscount = 0;
            }
            // Grand Management
            let grandTotal = 0;
            $('.current_price').each(function () {
                let innerQuantity = $(this).closest('tr').find('.current_quantity').val();
                let innerPriceTotal = Number($(this).val()) * Number(innerQuantity);
                grandTotal += innerPriceTotal;
            });
            $("#grand_total").val(grandTotal.toFixed(2));

            //Net Total
            let netTotal = 0;
            netTotal = grandTotal - totalDiscount;
            $("#net_total").val(netTotal.toFixed(2));

            //due amount
            let dueAmount = 0;
            let paidPercent = 0;
            let paidAmount = $("#total_paid_amount").val();

            paidPercent = (paidAmount / netTotal) * 100
            $("#paid_percentage").val(!isNaN(paidPercent) ? paidPercent.toFixed(2) : '0.00');

            dueAmount = netTotal - paidAmount;
            $("#total_dues_amount").val(!isNaN(dueAmount) ? dueAmount.toFixed(2) : '0.00');

            if (($('input[name="style"]:checked').val() == 'withoutBooking') || (isFor == 1)) {
                console.log("WOB");
                // Misc Discount
                let miscDiscountWob = Number($("#misc_discount_total_wob").val());
                totalDiscount += miscDiscountWob;

                netTotal = grandTotal - totalDiscount;

                $("#discount_total_wob").val(!isNaN(totalDiscount) ? totalDiscount.toFixed(2) : '0.00');
                $("#grand_total_wob").val(grandTotal.toFixed(2));
                $("#net_total_wob").val(netTotal.toFixed(2));

                let wob_dueAmount = 0;
                let wob_paidPercent = 0;
                let wob_paidAmount = $("#total_paid_amount_wob").val();

                wob_paidPercent = (wob_paidAmount / netTotal) * 100
                $("#paid_percentage_wob").val(!isNaN(wob_paidPercent) ? wob_paidPercent.toFixed(2) : '0.00');

                wob_dueAmount = netTotal - wob_paidAmount;
                $("#total_dues_amount_wob").val(!isNaN(wob_dueAmount) ? wob_dueAmount.toFixed(2) : '0.00');
            }
        }

        function invoiceeFullPaid() {
            var grandTotal = $("#net_total").val();
            $("#total_paid_amount").val(grandTotal);
        }

        function searchBooking(){
            var booking_no = $('#booking_no').val();
            if ( booking_no == 0) {
                alert('Please select Booking No !');
                return false;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'GET',
                url: "/autocomplete/booking?d=" + booking_no,
                success: function (data) {
                    console.log(data);
                    if($.trim(data)){
                        if (data.stage === false) {
                            document.getElementById('booking_id').value = data.id;
                            document.getElementById('phone_number').value = data.phone_number;
                            document.getElementById('sec_contact_no').value = data.sec_contact_no;
                            document.getElementById('national_id_card').value = data.national_id_card;
                            document.getElementById('address').value = data.address;
                            document.getElementById('event_date').value = data.event_date;
                            document.getElementById('event_time').value = data.event_time;
                            document.getElementById('booking_detail').value = data.booking_detail;
                            document.getElementById('customer_id').value = data.customer_option;
                            document.getElementById('customer_option').value = data.customer;
                            document.getElementById('start_time').value = data.start_time;
                            document.getElementById('end_time').value = data.end_time;

                            $('#submitbtn').attr('disabled',false);
                            // console.log(data['data'].event_time);
                        } else {
                            alert('This event already has a stage booking.');
                            document.getElementById('booking_id').value = null;
                            document.getElementById('phone_number').value = null;
                            document.getElementById('sec_contact_no').value = null;
                            document.getElementById('national_id_card').value = null;
                            // document.getElementById('event_area').value = data['data'].event_area;
                            document.getElementById('address').value = null;
                            document.getElementById('event_date').value = null;
                            document.getElementById('event_time').value = null;
                            document.getElementById('booking_detail').value = null;
                            document.getElementById('customer_id').value = null;
                            document.getElementById('customer_option').value = null;
                        }
                    }

                }
            });

        }


        function getCustomerInfo(cElement){
            var customerId = $('.selCustom').val();
            //console.log(customerId);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'GET',
                url: "/autocomplete/customer?d=" + customerId,
                success: function (data) {
                    //console.log(data);
                    if($.trim(data)){
                        if(data.cnic == null){

                            return false;
                        }
                        else{
                            document.getElementById('phone_number_wob').value = data.customer_mobile;
                            document.getElementById('sec_contact_no_wob').value = data.phone;
                            document.getElementById('customer_name_wob').value = data.customer_name;
                            document.getElementById('address_wob').value = data.customer_address;
                            document.getElementById('customer_id_wob').value = data.id;
                        }

                    }

                }
            });
        }

        $(document).on('submit', 'form#customer_ajax_form', function(e) {
        e.preventDefault();
        var form = $(this);
        var data = form.serialize();

        $.ajax({
            method: 'POST',
            url: form.attr('action'),
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result.success === true) {
                    toastr.success(result.msg);

                    let customerCnic = result.customer.cnic;
                    let customerId = result.customer.id;
                    $('#customer_option_wob').append('<option value="' + customerId + '" selected="selected">' + result.customer.customer_name + ' [' + customerCnic + ']</option>');
                    $('#customer_id_wob').val(result.customer.id);
                    $('#customer_name_wob').val(result.customer.customer_name);
                    $('#sec_contact_no_wob').val(result.customer.customer_mobile);
                    $('#address_wob').val(result.customer.customer_address);
                    $('#phone_number_wob').val(result.customer.phone);

                    $('#customer_add_modal').modal('hide');
                    $('#modal_customer_name').val('');
                    $('#modal_customer_cnic').val('');
                    $('#modal_customer_mobile').val('');
                    $('#modal_customer_phone').val('');
                    $('#modal_customer_address').val('');
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

        $("#event_time_wob").change(function () {
            let eventTime = this.value;
            if (eventTime == 1) {
                $('#start_time_wob').val('12:00');
                $('#end_time_wob').val('16:00');
            } else {
                $('#start_time_wob').val('18:00');
                $('#end_time_wob').val('22:00');
            }
        });


    </script>
@endsection
