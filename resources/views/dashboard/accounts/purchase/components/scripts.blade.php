@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/dropify/js/dropify.min.js') }}"></script>
@endsection

@section('innerScript')
    @include('dashboard.accounts.common.modals.modals-script')
    <script>
        $(document).ready(function(){
            $('.select2').select2();
            $('.dropify').dropify();
        @if (isset($for))
            applyCalculations();
        @endif
        });

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

        function applySearchingOnItems(cElement) {
            let options = {
                minLength: 1,
                source: function( request, response ) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('product.autocomplete') }}",
                        data: {'product_name': $(cElement).val()},
                        dataType: 'json',
                        success: function (data) {
                            response( data );
                        }
                    });
                },
                focus: function( event, ui ) {
                    return false;
                },
                select: function( event, ui ) {

                    let productID = 0;
                    let productInList = false;

                    $('.current_id').each(function () {
                        productID = $(this).val();
                        if (productID == ui.item.value) {
                            productInList = true;
                            return false;
                        }
                    });

                    if (productInList === true) {
                        alert('Product is already in list.');
                        $(cElement).val('');
                        return false;
                    } else {
                        $(this).val(ui.item.label);
                        $(cElement).closest('tr').find('.current_id').val(ui.item.value);
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('product.retrieved') }}",
                            data: {'product_id': ui.item.value},
                            dataType: 'json',
                            success: function (data) {
                                $(cElement).closest('tr').find('.current_price').val(data.price);
                                $(cElement).closest('tr').find('.current_qty_available').val(data.total_product);
                            },
                        });
                        $(this).unbind("change");
                        return false;
                    }
                }
            };

            $('body').on('keypress.autocomplete', '.current_product', function() {
                $(this).autocomplete(options);
            });
        }

        function applyCalculations() {
            // Grand Management
            let grandTotal = 0;
            let innerPriceTotal = 0;
            $('.current_total').each(function () {
                innerPriceTotal = Number($(this).val().replace(/,/g, ''));
                grandTotal += innerPriceTotal;
            });
            $("#grand_total_amount").val(grandTotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

            // Misc Discount
            let miscDiscount = Number($('#total_discount').val());

            //Net Total
            let netTotal = 0;
            netTotal = grandTotal - miscDiscount;
            $("#net_total_amount").val(netTotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

            $('#paid_amount').attr('max', netTotal);

            //Remaining Amount
            let dueAmount = 0;
            let paidPercent = 0;
            let paidAmount = $("#paid_amount").val();

            dueAmount = netTotal - paidAmount;
            paidPercent = ((paidAmount / netTotal) * 100);

            $("#paid_percentage").val(!isNaN(paidPercent) ? paidPercent.toFixed(2) : '0.00');
            $("#due_amount").val(!isNaN(dueAmount) ? dueAmount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') : '0.00');
        }

        function applyPrice(cElement) {
            if ($(cElement).closest('tr').find('.current_id').val() != '') {
                let price = Number($(cElement).val());
                let quantity = Number($(cElement).closest('tr').find('.current_quantity').val());
                let taxPercentage = Number($(cElement).closest('tr').find('.current_tax').val());

                let netTotal = (quantity * price);
                let taxAmount = ((netTotal * taxPercentage) / 100);
                let currentTotal = netTotal + taxAmount;

                $(cElement).closest('tr').find('.current_total').val(currentTotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                $(cElement).closest('tr').find('.current_tax_amount').val(taxAmount);

                applyCalculations();
            }
        }

        function applyQuantity(cElement) {
            if ($(cElement).closest('tr').find('.current_id').val() != '') {
                let quantity = Number($(cElement).val());
                let price = Number($(cElement).closest('tr').find('.current_price').val());
                let taxPercentage = Number($(cElement).closest('tr').find('.current_tax').val());

                let netTotal = (quantity * price);
                let taxAmount = ((netTotal * taxPercentage) / 100);
                let currentTotal = netTotal + taxAmount;

                $(cElement).closest('tr').find('.current_total').val(currentTotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                $(cElement).closest('tr').find('.current_tax_amount').val(taxAmount);

                applyCalculations();
            }
        }

        function applyTax(cElement) {
            if ($(cElement).closest('tr').find('.current_id').val() != '') {
                let taxPercentage = Number($(cElement).val());
                let price = Number($(cElement).closest('tr').find('.current_price').val());
                let quantity = Number($(cElement).closest('tr').find('.current_quantity').val());

                let netTotal = (quantity * price);
                let taxAmount = ((netTotal * taxPercentage) / 100);
                let currentTotal = netTotal + taxAmount;

                $(cElement).closest('tr').find('.current_total').val(currentTotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                $(cElement).closest('tr').find('.current_tax_amount').val(taxAmount);

                applyCalculations();
            }
        }

        function getPaymentAccounts(cElement) {
            let paymentType = $(cElement).val();

            $('#paymentAccountDiv').hide('slow');
            $.ajax({
                type: 'POST',
                url: "{{ route('api.payment.accounts.by.type') }}",
                data: {'paymentType': paymentType},
                dataType: 'json',
                success: function (result) {
                    console.log(result);
                    if (result.success === true) {
                        $('#payment_account')
                            .empty()
                            .append($("<option value>Select Payment Account</option>"));
                        $.each(result.records, function (key, value) {
                            $('#payment_account')
                                .append($("<option></option>")
                                    .attr("value", key)
                                    .text(value));
                        });
                        $('#paymentAccountDiv').show('slow');
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        }
    </script>
@endsection
