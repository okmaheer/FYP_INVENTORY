@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    {{-- <script src="{{ asset('js/admin_js/invoice.js') }}"></script> --}}
@endsection
@section('innerScript')
    <script>
        let tax_type = 0;
        let tax_value = 0;

        (function() {

            $('.select2').select2();
            setOutdoorView();

            @if (isset($for))
                applyCalculations();
                getCustomerInfo(null);
                var t_component = $('#tax_id');
                getTaxValue(t_component);
            @endif

            //disable form to submit on enter
            $(document).on("keydown", ":input:not(textarea)", function(event) {
                if (event.key == "Enter") {
                    event.preventDefault();
                }
            });
        })();

        function SubmitAndPrint() {
            $("#doPrint").val('1');
            $("#booking_form").submit();
        }

        function setOutdoorView() {
            var siteId = $('#event_area').val();
            if (siteId == 2) {
                $('#outdoor_row').show();
            } else {
                $('#outdoor_row').hide();
            }
        }

        function ResetFoodMenu() {
            swal.fire({
                title: "Do you really want to reset food items menu?",
                type: "question",
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonText: 'Yes! Reset Menu',
                confirmButtonColor: '#00a5bb',
                cancelButtonColor: '#f82269',

            }).then((result) => {
                if (result.value === true) {
                    $.ajax({
                        type: 'GET',
                        url: "/api/marquee/reset_food_menu",
                        success: function(response) {
                            if (response.status === true) {
                                $("#food_items_body").empty().append(response.data);
                                applyCalculations();
                            } else {
                                swal.fire("Unable to reset food menu.", {
                                    type: "error",
                                });
                            }
                        }
                    });
                }
            });
        }

        function getMenuFoodItems(cElement) {
            let id = $(cElement).find('option:selected').val();
            $.ajax({
                type: 'GET',
                url: "/api/marquee/food_items_by_menu_id/" + id,
                success: function(response) {
                    if (response.status === true) {
                        $("#food_items_body").empty().append(response.data);
                        let no_persons = Number($("#no_person").val());
                        $("#food_items_body .current_quantity").each(function() {
                            $(this).val(no_persons);
                        });
                        applyCalculations();
                    } else {
                        alert("No Menu Found with this Id");
                    }
                }
            });
        }

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

        function applySearchingForAddOn(cElement) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var options = {
                source: function(request, response) {
                    $.ajax({
                        type: 'GET',
                        url: "/autocomplete/add-on-features?d=" + $(cElement).val(),
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                focus: function(event, ui) {
                    // $(this).val(ui.item.label);
                    return false;
                },
                select: function(event, ui) {
                    $(this).val(ui.item.label);
                    //$(cElement).closest('tr').find('.current_price').val(ui.item.extra.price);
                    $(cElement).closest('tr').find('.current_id').val(ui.item.value);
                    applyCalculations();
                    $(this).unbind("change");
                    return false;
                }
            };
            $('body').on('keypress.autocomplete', '.add_on_feature_name', function() {
                $(this).autocomplete(options);
            });
        }

        function applySearchingForSeatPlannings(cElement) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var options = {
                source: function(request, response) {
                    $.ajax({
                        type: 'GET',
                        url: "/autocomplete/seat-plannings?d=" + $(cElement).val(),
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                focus: function(event, ui) {
                    // $(this).val(ui.item.label);
                    return false;
                },
                select: function(event, ui) {
                    $(this).val(ui.item.label);
                    $(cElement).closest('tr').find('.current_id').val(ui.item.value);
                    //$(cElement).closest('tr').find('.current_price').val(ui.item.extra.price);
                    applyCalculations();
                    $(this).unbind("change");
                    return false;
                }
            };
            $('body').on('keypress.autocomplete', '.seat_planning_name', function() {
                $(this).autocomplete(options);
            });
        }

        function applyPriceOnly(cElement) {

            let price = Number($(cElement).val());
            // let discount = $(cElement).closest('tr').find('.current_discount').val();
            let quantity = 1;

            let final_price = quantity * price;
            // console.log(final_price);
            //let find_discount = +(final_price * discount / 100);
            // let find_discount = +(discount);
            let current_total = final_price; // - find_discount;
            // console.log(current_total);

            $(cElement).closest('tr').find('.current_total').val(current_total.toFixed(2));

            applyCalculations();
        }

        function applySearchingForExtraFoodItems(cElement) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var options = {
                source: function(request, response) {
                    $.ajax({
                        type: 'GET',
                        url: "/autocomplete/extra_food_items?d=" + $(cElement).val(),
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                focus: function(event, ui) {
                    // $(this).val(ui.item.label);
                    return false;
                },
                select: function(event, ui) {
                    $(this).val(ui.item.label);
                    //$(cElement).closest('tr').find('.current_price').val(ui.item.extra.price);
                    $(cElement).closest('tr').find('.current_id').val(ui.item.value);
                    applyCalculations();
                    $(this).unbind("change");
                    return false;
                }
            };
            $('body').on('keypress.autocomplete', '.current_new_item', function() {
                $(this).autocomplete(options);
            });
        }

        function applySearchingForStageDecorations(cElement) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var options = {
                source: function(request, response) {
                    $.ajax({
                        type: 'GET',
                        url: "/autocomplete/stage-decorations?d=" + $(cElement).val(),
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                focus: function(event, ui) {
                    // $(this).val(ui.item.label);
                    return false;
                },
                select: function(event, ui) {
                    $(this).val(ui.item.label);
                    $(cElement).closest('tr').find('.current_id').val(ui.item.value);
                    // $(cElement).closest('tr').find('.current_price').val(ui.item.extra.price);
                    applyCalculations();
                    $(this).unbind("change");
                    return false;
                }
            };
            $('body').on('keypress.autocomplete', '.stage_decoration_name', function() {
                $(this).autocomplete(options);
            });
        }

        function applySearchingOnMenu(cElement) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var options = {
                source: function(request, response) {
                    $.ajax({
                        type: 'GET',
                        url: "/autocomplete/menus?d=" + $(cElement).val(),
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                focus: function(event, ui) {
                    // $(this).val(ui.item.label);
                    return false;
                },
                select: function(event, ui) {
                    $(this).val(ui.item.label);
                    $(cElement).closest('tr').find('.current_id').val(ui.item.value);
                    // $(cElement).closest('tr').find('.current_price').val(ui.item.extra.price);
                    applyCalculations();
                    $(this).unbind("change");
                    return false;
                }
            };
            $('body').on('keypress.autocomplete', '.current_product', function() {
                $(this).autocomplete(options);
            });
        }

        function applyPrice(cElement) {

            let price = Number($(cElement).val());
            // let discount = $(cElement).closest('tr').find('.current_discount').val();
            let quantity = Number($(cElement).closest('tr').find('.current_quantity').val());

            let final_price = quantity * price;
            //let find_discount = +(final_price * discount / 100);
            // let find_discount = +(discount);
            let current_total = final_price; // - find_discount;
            $(cElement).closest('tr').find('.current_total').val(current_total.toFixed(2));

            applyCalculations();
        }

        function applyDiscount(cElement) {

            /* let discount = $(cElement).val();
            let price = $(cElement).closest('tr').find('.current_price').val();
            let quantity = $(cElement).closest('tr').find('.current_quantity').val();

            let final_price = quantity * price;
            let find_discount = +(discount );
            let current_total = final_price - find_discount;
            $(cElement).closest('tr').find('.current_total').val(current_total.toFixed(2)); */

            applyCalculations();
        }

        function applyAddonDiscount(cElement) {

            /* let discount = $(cElement).val();
            let price = $(cElement).closest('tr').find('.current_price').val();
            let current_hourly = $(cElement).closest('tr').find('.current_hourly').val();
            let quantity = $(cElement).closest('tr').find('.current_quantity').val();

            let final_price = 0;
            if(quantity > 0 ){
                final_price = price * quantity;
            } else {
                final_price = (price * current_hourly);
            }
            let find_discount = +(discount );
            let current_total = final_price - find_discount;
            $(cElement).closest('tr').find('.current_total').val(current_total.toFixed(2)); */

            applyCalculations();
        }

        function applySeatingDiscount(cElement) {

            /* let discount = $(cElement).val();
            let price = $(cElement).closest('tr').find('.current_price').val();
            let quantity = $(cElement).closest('tr').find('.current_quantity').val();

            let final_price = quantity * price;
            let find_discount = +(discount) ;
            let ttl_discount_per_unit = find_discount * quantity;

            let current_total = final_price - ttl_discount_per_unit;
            $(cElement).closest('tr').find('.current_total').val(current_total);

            let discount = $(cElement).val();
            let seat_net_total = $(cElement).closest('tr').find('.current_net_total').val();

            let find_discount = +(discount) ;

            let current_total = seat_net_total - find_discount;
            $(cElement).closest('tr').find('.current_total').val(current_total.toFixed(2)); */

            applyCalculations();
        }

        function applyQuantity(cElement) {

            let quantity = Number($(cElement).val());
            let price = Number($(cElement).closest('tr').find('.current_price').val());
            // let discount = $(cElement).closest('tr').find('.current_discount').val();

            let final_price = quantity * price;
            //let find_discount = +(final_price * discount / 100);
            // let find_discount = +(discount);
            let current_total = final_price; // - find_discount;
            let current_net_total = final_price;

            $(cElement).closest('tr').find('.current_total').val(current_total.toFixed(2));
            $(cElement).closest('tr').find('.current_net_total').val(current_net_total.toFixed(2));

            applyCalculations();
        }

        function applyCalculations() {
            let grandTotal = 0;
            let netTotal = 0;
            let totalDiscount = 0;
            let tax_amount = 0;
            let additional_item_amount = 0;
            let additional_charges = 0;

            //Grand Total Calculcation
            let no_of_person = Number($("#no_person").val());
            let rate_per_person = Number($("#rate_per_head").val());
            additional_charges = Number($("#additional_charges").val());
            grandTotal = (no_of_person * rate_per_person);

            // Total of All Additional Items
            $('.current_total').each(function() {
                additional_item_amount = Number($(this).val());
                grandTotal += additional_item_amount;
            });

            //Add Additional Charges
            grandTotal += additional_charges;

            $("#grand_total").val(grandTotal.toFixed(2));

            //Discount Calculation
            let misc_disc_type = Number($('#misc_discount_type').val());
            let misc_disc_total = Number($('#misc_discount_total').val());

            if (misc_disc_type === 1) { //Fixed
                totalDiscount = misc_disc_total;
            } else if (misc_disc_type === 2) { //Percentage
                totalDiscount = ((grandTotal * misc_disc_total) / 100);
            } else if (misc_disc_type === 3) { //No of Person
                totalDiscount = (misc_disc_total * rate_per_person);
            } else {
                totalDiscount = 0;
            }
            $("#misc_discount_value").val(totalDiscount.toFixed(2));

            //Tax Calculation
            if (tax_type === 2) { //tax in percent
                tax_amount = Number(((grandTotal * tax_value) / 100));
            } else { //fix tax
                tax_amount = Number(tax_value);
            }
            $('#total_tax').val(tax_amount.toFixed(2));

            //Net Total
            netTotal = (grandTotal + tax_amount) - totalDiscount;
            $("#net_total").val(netTotal.toFixed(2));

            //due amount
            let dueAmount = 0;
            let paidPercent = 0;
            let paidAmount = Number($("#total_paid_amount").val());

            paidPercent = ((paidAmount / netTotal) * 100);
            $("#paid_percentage").val(!isNaN(paidPercent) ? paidPercent.toFixed(2) : '0.00');

            dueAmount = netTotal - $("#total_paid_amount").val();
            $("#total_dues_amount").val(!isNaN(dueAmount) ? dueAmount.toFixed(2) : '0.00');
        }

        function invoiceeFullPaid() {
            var grandTotal = $("#net_total").val();
            $("#total_paid_amount").val(grandTotal);
        }

        function searchBooking() {
            var booking_no = $('#booking_no').val();
            if (booking_no == 0) {
                alert('Please select Booking No !');
                return false;
            }
            // console.log('booking number is :'+ booking_no);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'GET',
                url: "/autocomplete/booking?d=" + booking_no,
                success: function(data) {
                    if ($.trim(data)) {
                        document.getElementById('phone_number').value = data['data'].phone_number;
                        document.getElementById('sec_contact_no').value = data['data'].sec_contact_no;
                        document.getElementById('national_id_card').value = data['data'].national_id_card;
                        // document.getElementById('event_area').value = data['data'].event_area;
                        document.getElementById('address').value = data['data'].address;
                        document.getElementById('event_date').value = data['data'].event_date;
                        document.getElementById('event_time').value = data['data'].event_time;
                        document.getElementById('booking_detail').value = data['data'].booking_detail;
                        document.getElementById('customer_id').value = data['data'].customer_option;
                        document.getElementById('customer_option').value = data.customer;
                        console.log(data);
                    }

                }
            });

        }

        function getCustomerInfo(cElement) {
            var customerId = $('#customer_option').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'GET',
                url: "/autocomplete/customer?d=" + customerId,
                success: function(data) {
                    if ($.trim(data)) {
                        if (data.cnic == null) {
                            return false;
                        } else {
                            document.getElementById('phone_number').value = data.customer_mobile;
                            //document.getElementById('sec_contact_no').value = data.phone;
                            document.getElementById('customer_name').value = data.customer_name;
                            document.getElementById('address').value = data.customer_address;
                            //console.log(data);
                        }

                    }

                }
            });
        }

        function applyAddonPrice(cElement) {

            let price = $(cElement).closest('tr').find('.current_price').val();
            // let discount = $(cElement).closest('tr').find('.current_discount').val();
            let quantity = $(cElement).closest('tr').find('.current_quantity').val();
            let current_hourly = $(cElement).closest('tr').find('.current_hourly').val();
            let final_price = 0;

            if (quantity > 0) {
                final_price = price * quantity;
            } else {
                final_price = (price * current_hourly);
            }

            // let find_discount = +(discount);
            let current_total = final_price; // - find_discount;
            let current_net_total = final_price;
            $(cElement).closest('tr').find('.current_total').val(current_total.toFixed(2));
            $(cElement).closest('tr').find('.current_net_total').val(current_net_total.toFixed(2));

            applyCalculations();
        }

        function applyAddonDiscount(cElement) {

            /* let discount = $(cElement).val();
            let price = $(cElement).closest('tr').find('.current_net_total').val();

            let find_discount = +(discount );
            let current_total = price - find_discount;
            $(cElement).closest('tr').find('.current_total').val(current_total.toFixed(2)); */

            applyCalculations();
        }

        function customer() {

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
                customer_name: name,
                cnic: cnic,
                customer_mobile: customer_mobile,
                phone: phone,
                customer_address: customer_address
            };
            $.ajax({
                type: type,
                data: formData,
                url: "{{ route('add.customer.ajax') }}",
                dataType: 'json',
                success: function(data) {
                    if ($.trim(data)) {
                        var cc = cnic;

                        $('#customer_option').append('<option value="' + data.id + '" selected="selected">' +
                            cc + '</option>');

                        document.getElementById('customer_name').value = data.customer_name;
                        document.getElementById('phone_number').value = customer_mobile;
                        //document.getElementById('sec_contact_no').value = data.phone;
                        document.getElementById('address').value = data.customer_address;

                    }

                }
            });

        }

        function getTaxValue(cElement) {
            let oid = $(cElement).val();

            $.ajax({
                type: 'POST',
                url: base_url + "/api/get_tax_details" + "?taxID=" + oid,
                success: function(result) {
                    if (result.success === true) {
                        result.data;
                        tax_type = result.data.tax_type;
                        tax_value = result.data.tax_value;

                        applyCalculations();
                    } else {
                        tax_type = 0;
                        tax_value = 0;
                        applyCalculations();
                    }
                }
            });
        }
    </script>
@endsection
