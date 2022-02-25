@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
@endsection

@section('innerScript')
    @include('dashboard.accounts.common.modals.modals-script')
    <script>
        let taxType = 0;
        let taxValue = 0;

        $(document).ready(function(){
            $('.select2').select2();
            @isset($for)
                $('#customer_id').trigger('change');
                getTaxValue({{ $model->tax_id }});
                applyCalculations();
            @endisset
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
                        data: {'product_name': $(cElement).val(), 'type': 'sale'},
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
                                $(cElement).closest('tr').find('.current_supplier_price').val(data.supplier_price);
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
            let netTotal = 0;

            $('.current_total').each(function () {
                innerPriceTotal = Number($(this).val().replace(/,/g, ''));
                grandTotal += innerPriceTotal;
            });
            $("#grand_total_price").val(grandTotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

            //Product Discount + Misc. Discount
            let totalDiscount = 0;
            let innerDiscount = 0;
            $('.current_discount_amount').each(function () {
                innerDiscount = Number($(this).val());
                totalDiscount += innerDiscount;
            });

            let miscDiscount = Number($("#invoice_discount").val());
            totalDiscount += miscDiscount;
            $("#total_discount").val(totalDiscount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

            netTotal = (grandTotal - miscDiscount);

            //Tax
            let totalTax = 0;
            let innerTax = 0;
            let globalTax = 0;
            $('.current_tax_amount').each(function () {
                innerTax = Number($(this).val());
                totalTax += innerTax;
            });
            if (taxType === 2) { //tax in percent
                globalTax = Number(((netTotal * taxValue) / 100));
            } else { //fix tax
                globalTax = Number(taxValue);
            }
            totalTax += globalTax;
            $('#total_tax').val(totalTax.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

            //Freight Charges
            let freightCharges = Number($("#shipping_cost").val());
            netTotal += (freightCharges + totalTax);
            $("#net_total").val(netTotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
            $("#paid_amount").attr('max', netTotal);

            //Remaining Balance
            let paidAmount = $("#paid_amount").val();
            let dueAmount = (netTotal - paidAmount);

            $("#due_amount").val(dueAmount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        }

        function applyRowCalculation(cElement) {
            let taxAmount = 0;
            let discountAmount = 0;
            let rowTotal = 0;

            if ($(cElement).closest('tr').find('.current_id').val() != '') {
                let price = Number($(cElement).closest('tr').find('.current_price').val());
                let quantity = Number($(cElement).closest('tr').find('.current_quantity').val());
                let taxPercentage = Number($(cElement).closest('tr').find('.current_tax').val());
                let discountPercentage = Number($(cElement).closest('tr').find('.current_discount').val());

                rowTotal = (price * quantity);

                discountAmount = ((rowTotal * discountPercentage) / 100);
                rowTotal -= discountAmount;

                taxAmount = ((rowTotal * taxPercentage) / 100);
                rowTotal += taxAmount;

                $(cElement).closest('tr').find('.current_tax_amount').val(taxAmount);
                $(cElement).closest('tr').find('.current_discount_amount').val(discountAmount);
                $(cElement).closest('tr').find('.current_total').val(rowTotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

                applyCalculations();
            }
        }

        function getTaxValue(taxID) {

            $.ajax({
                type: 'POST',
                data: {'taxID': taxID},
                url: "{{ route('api.tax.details') }}",
                success: function (result) {
                    if (result.success === true) {
                        taxType = Number(result.data.tax_type);
                        taxValue = Number(result.data.tax_value);

                        applyCalculations();
                    } else {
                        taxType = 0;
                        taxValue = 0;
                        applyCalculations();
                    }
                }
            });
        }
    </script>
@endsection
