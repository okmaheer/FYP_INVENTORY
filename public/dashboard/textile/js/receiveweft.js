
//Calculate store product
"use strict";

function calculate_store(sl) {

    var ttl_length = 0;
    var weight = 0;
    var cost_per_meter = 0;

    var per_than_qty = $("#per_than_qty_" + sl).val();
    var than_receive = $("#than_receive_" + sl).val();
    var pick = $("#pick_" + sl).val();
    var arz = $("#arz_" + sl).val();
    var twenty = $("#twenty_" + sl).val();
     var convertion = $("#convertion_" + sl).val();
     var count = $("#count_" + sl).val();
    var forty = $("#forty_" + sl).val();
    var rate = $("#rate_" + sl).val();
    var givenlength = $("#issue_length_qty_" + sl).val();

    ttl_length = than_receive * per_than_qty;
    if (ttl_length > givenlength) {
        alert('Given Length exceded the Available Lenght!');
        return false;
    }
    $("#total_length_" + sl).val(ttl_length.toFixed(2));

    twenty = parseInt(twenty);
    count = parseInt(count);
    convertion = parseInt(convertion);
    forty = parseInt(forty);
    rate = parseInt(rate);
    arz = parseInt(arz);
    pick = parseInt(pick);
    weight = pick*arz;
    weight = weight/twenty;
    weight = weight/count;
    weight = weight*convertion;
    $("#weight_per_than_" + sl).val(weight.toFixed(2));
    cost_per_meter = weight/forty;
    console.log(cost_per_meter);
    cost_per_meter = cost_per_meter*rate;

    console.log(cost_per_meter);
    $("#per_meter_cost_" + sl).val(cost_per_meter.toFixed(2));

    cost_per_meter = cost_per_meter*ttl_length;

    $("#total_cost_" + sl).val(cost_per_meter.toFixed(2));





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
            var available_quantity    = 'issue_length_qty_'+sr_no;

            var form2Data = {
                product_id: ui.item.value,
                supplier_id: supplier_id
            };
            var ajax2url = '/dashboard/textile/retrieve_issue_weft_data';

            $.ajax({
                type: type,
                url: base_url + ajax2url,
                data: form2Data,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    $('#'+available_quantity).val(data.weft_amount);
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




// "use strict";

// function product_pur_or_list(sl) {

//     var sr_no = sl;

//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
//         }
//     });

//     var type = "POST";
//     var supplier_id = $('#supplier_id').val();
//     if ( supplier_id == 0) {
//         alert('Please select Supplier !');
//         return false;
//     }
//     // Auto complete
//     var options = {
//         minLength: 0,
//         source: function( request, response ) {

//             var formData = {
//                 product_name: jQuery('#product_name_'+sl).val()
//             };


//             var ajaxurl = '/product_autocomplete';
//             $.ajax({
//                 type: type,
//                 url: base_url + ajaxurl,
//                 data: formData,
//                 dataType: 'json',
//                 success: function (data) {
//                     response( data );
//                 }
//             });
//         },
//         focus: function( event, ui ) {
//             $(this).val(ui.item.label);
//             return false;
//         },
//         select: function( event, ui ) {
//             $(this).parent().parent().find(".autocomplete_hidden_value").val(ui.item.value);
//             var sl = $(this).parent().parent().find(".sl").val();

//             var available_weight    = 'available_weight_'+sr_no;
//             var available_quantity    = 'available_quantity_'+sr_no;

//             var form2Data = {
//                 product_id: ui.item.value,
//                 supplier_id: supplier_id
//             };
//             var ajax2url = '/dashboard/textile/retrieve_issue_warp_data';

//             $.ajax({
//                 type: type,
//                 url: base_url + ajax2url,
//                 data: form2Data,
//                 dataType: 'json',
//                 success: function (data) {
//                     console.log(data);
//                     $('#'+available_quantity).val(data.issue_length);
//                     // $('#'+available_weight).val(data.total_weight);
//                 },
//                 // error: function (data) {
//                 //     console.log(data);
//                 // }
//             });



//             $(this).unbind("change");
//             return false;
//         }

//     }

//     $('body').on('keypress.autocomplete', '.product_name', function() {
//         $(this).autocomplete(options);
//     });


// }


// "use strict";

// function product_pur_or_list_west(sl) {

//     var base_url = $('#base_url').val();
//     var csrf_test_name = $('[name="csrf_test_name"]').val();


//     // Auto complete
//     var options = {
//         minLength: 0,
//         source: function(request, response) {
//             var product_name = $('#product_name_' + sl).val();
//             $.ajax({
//                 url: base_url + "purchase/purchase/bdtask_product_search_by_supplier",
//                 method: 'post',
//                 dataType: "json",
//                 data: {
//                     term: request.term,
//                     product_name: product_name,
//                     csrf_test_name: csrf_test_name
//                 },
//                 success: function(data) {
//                     response(data);
//                 }
//             });
//         },
//         focus: function(event, ui) {
//             $(this).val(ui.item.label);
//             return false;
//         },
//         select: function(event, ui) {
//             $(this).parent().parent().find(".autocomplete_hidden_value").val(ui.item.value);
//             var sl = $(this).parent().parent().find(".sl").val();

//             var product_id = ui.item.value;


//             var base_url = $('.baseUrl').val();


//             var available_quantity = 'available_quantity_' + sl;
//             var product_rate = 'product_rate_' + sl;




//             $.ajax({
//                 type: "POST",
//                 url: base_url + "purchase/purchase/bdtask_retrieve_product_data_west",
//                 data: { product_id: product_id, csrf_test_name: csrf_test_name },
//                 cache: false,
//                 success: function(data) {
//                     // alert("hel");
//                     console.log(data);
//                     obj = JSON.parse(data);
//                     $('#' + available_quantity).val(obj.total_product);
//                     // $('#' + product_rate).val(obj.supplier_price);

//                 }
//             });

//             $(this).unbind("change");
//             return false;
//         }
//     }

//     $('body').on('keypress.autocomplete', '.product_name', function() {
//         $(this).autocomplete(options);
//     });

// }


// "use strict";

// function bank_paymet(val) {
//     if (val == 2) {
//         var style = 'block';
//         document.getElementById('bank_id').setAttribute("required", true);
//     } else {
//         var style = 'none';
//         document.getElementById('bank_id').removeAttribute("required");
//     }

//     document.getElementById('bank_div').style.display = style;
// }

// $(document).ready(function() {
//     var paytype = $("#editpayment_type").val();
//     if (paytype == 2) {
//         $("#bank_div").css("display", "block");
//     } else {
//         $("#bank_div").css("display", "none");
//     }

//     $(".bankpayment").css("width", "100%");
// });


// $(document).ready(function() {
//     "use strict";
//     var csrf_test_name = $('#CSRF_TOKEN').val();
//     var total_purchase_no = $("#total_purchase_no").val();
//     var base_url = $("#base_url").val();
//     var currency = $("#currency").val();
//     var purchasedatatable = $('#PurList').DataTable({
//         responsive: true,

//         "aaSorting": [
//             [4, "desc"]
//         ],
//         "columnDefs": [
//             { "bSortable": false, "aTargets": [0, 1, 2, 3, 5, 6] },

//         ],
//         'processing': true,
//         'serverSide': true,


//         'lengthMenu': [
//             [10, 25, 50, 100, 250, 500, total_purchase_no],
//             [10, 25, 50, 100, 250, 500, "All"]
//         ],

//         dom: "'<'col-sm-4'l><'col-sm-4 text-center'><'col-sm-4'>Bfrtip",
//         buttons: [{
//             extend: "copy",
//             exportOptions: {
//                 columns: [0, 1, 2, 3, 4, 5] //Your Colume value those you want
//             },
//             className: "btn-sm prints"
//         }, {
//             extend: "csv",
//             title: "PurchaseLIst",
//             exportOptions: {
//                 columns: [0, 1, 2, 3, 4, 5] //Your Colume value those you want print
//             },
//             className: "btn-sm prints"
//         }, {
//             extend: "excel",
//             exportOptions: {
//                 columns: [0, 1, 2, 3, 4, 5] //Your Colume value those you want print
//             },
//             title: "PurchaseLIst",
//             className: "btn-sm prints"
//         }, {
//             extend: "pdf",
//             exportOptions: {
//                 columns: [0, 1, 2, 3, 4, 5] //Your Colume value those you want print
//             },
//             title: "PurchaseLIst",
//             className: "btn-sm prints"
//         }, {
//             extend: "print",
//             exportOptions: {
//                 columns: [0, 1, 2, 3, 4, 5] //Your Colume value those you want print
//             },
//             title: "<center> PurchaseLIst</center>",
//             className: "btn-sm prints"
//         }],


//         'serverMethod': 'post',
//         'ajax': {
//             'url': base_url + 'purchase/purchase/CheckPurchaseList',
//             "data": function(data) {
//                 data.fromdate = $('#from_date').val();
//                 data.todate = $('#to_date').val();
//                 data.csrf_test_name = csrf_test_name;

//             }
//         },
//         'columns': [
//             { data: 'sl' },
//             { data: 'chalan_no' },
//             { data: 'purchase_id' },
//             { data: 'supplier_name' },
//             { data: 'purchase_date' },
//             { data: 'total_amount', class: "total_sale text-right", render: $.fn.dataTable.render.number(',', '.', 2, currency) },
//             { data: 'button' },
//         ],

//         "footerCallback": function(row, data, start, end, display) {
//             var api = this.api();
//             api.columns('.total_sale', {
//                 page: 'current'
//             }).every(function() {
//                 var sum = this
//                     .data()
//                     .reduce(function(a, b) {
//                         var x = parseFloat(a) || 0;
//                         var y = parseFloat(b) || 0;
//                         return x + y;
//                     }, 0);
//                 $(this.footer()).html(currency + ' ' + sum.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
//             });
//         }


//     });


//     $('#btn-filter').click(function() {
//         purchasedatatable.ajax.reload();
//     });

// });
