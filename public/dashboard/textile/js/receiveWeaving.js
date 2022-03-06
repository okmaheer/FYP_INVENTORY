

function calculate_store(sl) {
 
    var weight = 0;
    var ttl_length = 0;
    var than_receive = $("#than_receive_" + sl).val();
    var per_than_qty = $("#per_than_qty_" + sl).val();
    var four = $("#four_" + sl).val();
    var reed = $("#reed_" + sl).val();
    var width = $("#width_" + sl).val();
    var twenty = $("#twenty_" + sl).val();
    var convertion = $("#convertion_" + sl).val(); 
    var count = $("#count_" + sl).val();
    var forty = $("#forty_" + sl).val();
    var rate = $("#rate_" + sl).val();
    var givenlength = $("#issue_weaving_stock_" + sl).val();
    reed = parseInt(reed);
    four = parseInt(four);
    width = parseInt(width);
    twenty = parseInt(twenty);
    count = parseInt(count);
    convertion = parseInt(convertion);
    forty = parseInt(forty);
    rate = parseInt(rate);
    ttl_length = than_receive * per_than_qty;
    if (ttl_length > givenlength) {
        alert('Given Length exceded the Available Lenght!');
        return false;
    }
    $("#total_qty_" + sl).val(ttl_length.toFixed(2));
    weight = four + reed;
    weight = weight*width;
    weight = weight/twenty;
    weight = weight/count;
    weight = weight*convertion;
    $("#weight_per_than_" + sl).val(weight.toFixed(2));
    console.log(weight);
    per_meter_cost = weight/forty;
    per_meter_cost = per_meter_cost*rate;
    $("#per_meter_cost_" + sl).val(per_meter_cost.toFixed(2));
    per_meter_cost = per_meter_cost*ttl_length;

    console.log(per_meter_cost);
    $("#total_cost_" + sl).val(per_meter_cost.toFixed(2));

 

   
   
  

    
    
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
            var available_quantity    = 'issue_weaving_stock_'+sr_no;

            var form2Data = {
                product_id: ui.item.value,
                supplier_id: supplier_id
            };
            var ajax2url = '/dashboard/textile/retrieve_receive_weaving_data';

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





