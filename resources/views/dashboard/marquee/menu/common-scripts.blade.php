@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
@endsection
@section('innerScript')
    <script>
        (function () {
            $('select').select2();
            @php
                if (isset($for)) {
                    echo 'applyCalculations();';
                }
            @endphp
        })();

        function applySearchingOnDishes(cElement) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var options = {
                source: function (request, response) {
                    $.ajax({
                        type: 'GET',
                        url: "/autocomplete/menus?d=" + $(cElement).val(),
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                focus: function (event, ui) {
                    $(this).val(ui.item.label);
                    return false;
                },
                select: function (event, ui) {
                    $(this).val(ui.item.label);
                    $(cElement).closest('tr').find('.current_id').val(ui.item.value);
                    $(cElement).closest('tr').find('.current_price').val(parseFloat(ui.item.extra.price).toFixed(2));
                    $(cElement).closest('tr').find('.current_unit').val(ui.item.extra.unit);
                    $(this).unbind("change");
                    return false;
                }
            };
            $('body').on('keypress.autocomplete', '.current_product', function () {
                $(this).autocomplete(options);
            });
        }

        function cloneRow(cElement) {
            let clone = $(cElement).closest('tr').clone();
            $(clone).find('input[type=text]').val('');
            $(clone).find('input[type=number]').val(0);
            $(clone).find('input[type=hidden]').val('');
            $(cElement).closest('tbody').append(clone);
        }

        function removeClonedRow(cElement) {
            let length = $(cElement).closest('tbody').find('tr').length;
            if (length > 1) {
                $(cElement).closest('tr').remove();
            } else {
                alert("At least one row is Required")
            }
        }

        function applyQuantity(cElement) {
            let quantity = $(cElement).closest('tr').find('.current_quantity').val();
            let price = $(cElement).closest('tr').find('.current_price').val();
            let final_price = parseFloat(quantity * price);

            $(cElement).closest('tr').find('.current_total').val(final_price.toFixed(2));

            applyCalculations();
        }

        function applyCalculations(){
            let grandTotal = 0;
            $('.current_total').each(function () {
                let innerPriceTotal = parseFloat($(this).val());
                grandTotal += innerPriceTotal;
            });
            $("#estimated_cost").val(grandTotal.toFixed(2));
        }
    </script>
@endsection