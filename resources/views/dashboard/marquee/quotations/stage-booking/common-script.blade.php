@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
@endsection
@section('innerScript')
    <script>
        var isFor = 0;
        $(document).ready(function () {
            @php
                if (isset($for)) {
                    echo 'applyCalculations();';
                }
            @endphp
        });

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
            // Discount Management
            let misc_discount = Number($("#misc_discount_total").val());
            let totalDiscount = 0;
            $('.current_discount').each(function () {
                let innerDiscount = Number($(this).val());
                totalDiscount += innerDiscount;
            });

            // $("#discount_total").val(!isNaN(totalDiscount) ? totalDiscount.toFixed(2) : '0.00');

            // Grand Management
            let grandTotal = 0;
            $('.current_total').each(function () {

                let innerPriceTotal = Number($(this).val());
                grandTotal += innerPriceTotal;
            });
            $("#grand_total").val(grandTotal.toFixed(2));

            //Net Total

            let netTotal = 0;
            netTotal = grandTotal - misc_discount;
            $("#net_total").val(netTotal.toFixed(2));

            //due amount
            let dueAmount = 0;
            let paidPercent = 0;
            let paidAmount = $("#total_paid_amount").val();

            paidPercent = (paidAmount / netTotal) * 100
            $("#paid_percentage").val(!isNaN(paidPercent) ? paidPercent.toFixed(2) : '0.00');

            dueAmount = netTotal - paidAmount;
            $("#total_dues_amount").val(!isNaN(dueAmount) ? dueAmount.toFixed(2) : '0.00');
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
                    if($.trim(data)){
                        document.getElementById('phone_number').value = data['data'].phone_number;
                        document.getElementById('sec_contact_no').value = data['data'].sec_contact_no;
                        document.getElementById('national_id_card').value = data['data'].national_id_card;
                        // document.getElementById('event_area').value = data['data'].event_area;
                        document.getElementById('address').value = data['data'].address;
                        document.getElementById('event_date').value = data['data'].event_date;
                        document.getElementById('event_time').value = data.eventTime;
                        document.getElementById('booking_detail').value = data['data'].booking_detail;
                        document.getElementById('customer_id').value = data['data'].customer_option;
                        document.getElementById('customer_option').value = data.customer;

                        $('#submitbtn').attr('disabled',false);
                        // console.log(data['data'].event_time);
                    }

                }
            });

        }

        function customer(){

            var name = $('#name').val();
            var cnic = $('#cnic').val();
            // console.log(cnic);
            var customer_mobile = $('#customer_mobile').val();
            var phone = $('#phone').val();
            var customer_address = $('#customer_address').val();



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            var type = "POST";
            var formData = {
                customer_name: name ,
                cnic:cnic,
                customer_mobile:customer_mobile,
                phone:phone,
                customer_address:customer_address
            };
            $.ajax({
                type: type,
                data: formData,
                url: "{{route('add.customer.ajax')}}",
                dataType: 'json',
                success: function (data) {
                  ;
                    if($.trim(data)){
                          var cc = data.cnic;
                          console.log(data);

                      $('#customer_option_wob').append('<option value="'+data.id+'" selected="selected">'+cc+'</option>');

                        document.getElementById('customer_name_wob').value = data.customer_name;
                        document.getElementById('phone_number_wob').value = data.customer_mobile;
                        document.getElementById('address_wob').value = data.customer_address;
                        document.getElementById('sec_contact_no_wob').value = data.phone;
                        document.getElementById('customer_id_wob').value = data.id;

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
                            // console.log(data);
                        }

                    }

                }
            });
        }


    </script>
@endsection
