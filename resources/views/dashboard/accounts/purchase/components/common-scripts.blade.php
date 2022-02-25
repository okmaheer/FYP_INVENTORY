@section('innerScriptFiles')
    @include('dashboard.accounts.sale.comp.common-script')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/admin_js/purchase.js') }}"></script>
@endsection

@section('innerScript')

    <script>

        function SubmitAndPrint() {
            $("#doPrint").val('1');
            $("#purchase_form").submit();
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

        function applySearchingOnRawItems(cElement) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var options = {
                source: function (request, response) {
                    $.ajax({
                        type: 'GET',
                        url: "/autocomplete/ingredients?d=" + $(cElement).val(),
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
                    $(this).unbind("change");
                    return false;
                }
            };
            $('body').on('keypress.autocomplete', '.current_product', function () {
                $(this).autocomplete(options);
            });
        }

        function applyPrice(cElement) {
            let price = Number($(cElement).val());
            let discount = Number($(cElement).closest('tr').find('.current_discount').val());
            let quantity = Number($(cElement).closest('tr').find('.current_quantity').val());

            let final_price = quantity * price;
            let find_discount = +(discount);
            let current_total = final_price - find_discount;

            $(cElement).closest('tr').find('.current_net_total').val(final_price.toFixed(2));
            $(cElement).closest('tr').find('.current_total').val(current_total.toFixed(2));

            applyCalculations();
        }

        function applyDiscount(cElement) {
            let discount = Number($(cElement).val());
            let price = Number($(cElement).closest('tr').find('.current_price').val());
            let quantity = Number($(cElement).closest('tr').find('.current_quantity').val());

            let final_price = quantity * price;
            let find_discount = +(discount );
            let current_total = final_price - find_discount;

            $(cElement).closest('tr').find('.current_net_total').val(final_price.toFixed(2));
            $(cElement).closest('tr').find('.current_total').val(current_total.toFixed(2));

            applyCalculations();
        }

        function applyQuantity(cElement) {

            let quantity = Number($(cElement).val());
            let price = Number($(cElement).closest('tr').find('.current_price').val());
            let discount = Number($(cElement).closest('tr').find('.current_discount').val());

            let final_price = quantity * price;
            let find_discount = +(discount);
            let current_total = final_price - find_discount;

            $(cElement).closest('tr').find('.current_total').val(current_total.toFixed(2));
            $(cElement).closest('tr').find('.current_net_total').val(final_price.toFixed(2));

            applyCalculations();
        }

        function applyCalculations() {
            // Discount Management
            let totalDiscount = 0;
            let innerDiscount = 0;
            $('.current_discount').each(function () {
                innerDiscount = Number($(this).val());
                totalDiscount += innerDiscount;
            });

            // Grand Management
            let grandTotal = 0;
            let innerPriceTotal = 0;
            $('.current_total').each(function () {
                //let innerQuantity = $(this).closest('tr').find('.current_quantity').val();
                innerPriceTotal = Number($(this).val());// * parseInt(innerQuantity);
                grandTotal += innerPriceTotal;

            });
            $("#grand_total").val(grandTotal.toFixed(2));

            // Misc Discount
            let misc_discount_total = Number($('#misc_discount_total').val());
            totalDiscount += misc_discount_total;
            $("#discount_total").val(!isNaN(totalDiscount) ? totalDiscount : 0);

            //Net Total
            let netTotal = 0;
            netTotal = grandTotal - misc_discount_total;
            $("#net_total").val(netTotal.toFixed(2));

            //due amount
            let dueAmount = 0;
            let paidPercent = 0;
            let paidAmount = $("#total_paid_amount").val();

            dueAmount = netTotal - $("#total_paid_amount").val();
            $("#total_due_amount").val(!isNaN(dueAmount) ? dueAmount.toFixed(2) : '0.00');
        }
    </script>

    <script>
        (function (){
            $('.select2').select2();

            @php
                if (isset($for)) {
                    echo "applyCalculations();\n";
                }
            @endphp
        })();
    </script>

@endsection
