

function calculate_store(sl) {
 
    
    var ttl_length = 0;
    var issue_than = $("#issue_than_" + sl).val();
    var than_per_qty = $("#than_per_qty_" + sl).val();
 


    ttl_length = issue_than * than_per_qty;
    $("#total_qty_" + sl).val(ttl_length.toFixed(2));
    
    
    // var gr_tot = reed = pick = warp = weft = 0;
    // var ttl_length =  0;
    // var sizing_count = $("#sizing_count_" + sl).val();

    // // var total_length_meter = $("#total_length_meter_" + sl).val();


    // var warp_weft = parseInt(warp) + parseInt(weft);
    // console.log(warp_weft + " warp_weft") ;
    // // ttl_length = warp + weft;
    // var ttl_length = reed * pick ;
    // console.log(ttl_length + " ttl_length");
    // ttl_length = ttl_length / warp_weft;
    // // console.log(ttl_length + " ttl_length " + warp_weft + " warp_weft");
    // if(ttl_length > 0 ){
    //     $("#total_length_meter_" + sl).val(ttl_length.toFixed(2));
    // }





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
    if ( supplier_id == 0) {
        alert('Please select Supplier !');
        return false;
    }
    // Auto complete
    var options = {
        minLength: 0,
        source: function( request, response ) {

            var formData = {
                product_name: jQuery('#product_name_'+sl).val()
            };


            var ajaxurl = '/product_autocomplete';
            $.ajax({
                type: type,
                url: base_url + ajaxurl,
                data: formData,
                dataType: 'json',
                success: function (data) {
                    response( data );
                }
            });
        },
        focus: function( event, ui ) {
            $(this).val(ui.item.label);
            return false;
        },
        select: function( event, ui ) {
            $(this).parent().parent().find(".autocomplete_hidden_value").val(ui.item.value);
            var sl = $(this).parent().parent().find(".sl").val();

            var available_weight    = 'available_weight_'+sr_no;
            var available_quantity    = 'weaving_receive_'+sr_no;

            var form2Data = {
                product_id: ui.item.value,
                supplier_id: supplier_id
            };
            var ajax2url = '/dashboard/textile/retrieve_issue_folding_data';
            
            $.ajax({
                type: type,
                url: base_url + ajax2url,
                data: form2Data,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    $('#'+available_quantity).val(data.weaving_amount);
                    // $('#'+available_weight).val(data.total_weight);
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



