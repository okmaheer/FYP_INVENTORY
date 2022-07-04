//Calculate store product
"use strict";

function calculate_store(sl) {


    var ttl_length = 0;
    // var ttl_length = $("#total_length_" + sl).val();
    var count = $("#weft_count_" + sl).val();

    var ttl_length = count * 2100;
    $("#total_length_meter_" + sl).val(ttl_length.toFixed(2));




}




"use strict";

function product_pur_or_list(sl) {

    var sr_no = sl;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    var type = "POST";
    var supplier_id = $('#supplier_id').val();
    if (supplier_id == 0) {
        alert('Please select Supplier !');
        return false;
    }
    // Auto complete
    var options = {
        minLength: 0,
        source: function(request, response) {

            var formData = {
                product_name: jQuery('#product_name_' + sl).val()
            };


            var ajaxurl = '/product_autocomplete';
            $.ajax({
                type: type,
                url: base_url + ajaxurl,
                data: formData,
                dataType: 'json',
                success: function(data) {
                    response(data);
                }
            });
        },
        focus: function(event, ui) {
            $(this).val(ui.item.label);
            return false;
        },
        select: function(event, ui) {
            $(this).parent().parent().find(".autocomplete_hidden_value").val(ui.item.value);
            var sl = $(this).parent().parent().find(".sl").val();

            var available_weight = 'available_weight_' + sr_no;
            var available_quantity = 'stock_purchase_' + sr_no;

            var form2Data = {
                product_id: ui.item.value,
                supplier_id: supplier_id
            };
            var ajax2url = '/dashboard/textile/retrieveIssueWeftData';

            $.ajax({
                type: type,
                url: base_url + ajax2url,
                data: form2Data,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#' + available_quantity).val(data.purchase_amount);
                    $('#' + available_weight).val(data.purchase_weight);
                },
                // error: function (data) {
                //     console.log(data);
                // }
            });



            $(this).unbind("change");
            return false;
        }

    }

    $('body').on('keypress.autocomplete', '.product_name', function() {
        $(this).autocomplete(options);
    });


}
