var count = 2;
var limits = 500;
"use strict";

function addPurchaseOrderField1(divName) {

    if (count == limits) {
        alert("You have reached the limit of adding " + count + " inputs");
    } else {
        var newdiv = document.createElement('tr');
        var tabin = "product_name_" + count;
        tabindex = count * 4,
            newdiv = document.createElement("tr");
        tab1 = tabindex + 1;

        tab2 = tabindex + 2;
        tab3 = tabindex + 3;
        tab4 = tabindex + 4;
        tab5 = tabindex + 5;
        tab6 = tab5 + 1;
        tab7 = tab6 + 1;



        newdiv.innerHTML = '<td><input type="text" name="product_name[]" id="product_name_' + count + '"  onkeypress="product_pur_or_list(' + count + ');" placeholder="Product Name" class="form-control product_name productSelection"> <input type="hidden" class="autocomplete_hidden_value product_id_' + count + '" name="product_id[]" id="SchoolHiddenId"/>  <input type="hidden" class="sl" value="' + count + '"> </td><td><input type="text" id="available_quantity_' + count + '" name="available_quantity[]" class="form-control text-right stock_ctn_1" placeholder="0.00" readonly="readonly"></td><td><input type="text" id="issue_bags_' + count + '" name="issue_bags[]" class="form-control text-right" onkeyup="calculate_store(' + count + ');" onchange="calculate_store(' + count + ');" placeholder="0.00" ></td><td><input type="text" id="bags_count_' + count + '" name="bags_count[]" class="form-control text-right stock_ctn_1" onkeyup="bags_count(' + count + ');" onchange="bags_count(' + count + ');" placeholder="0.00" ></td> <td><input type="text" id="total_length_' + count + '" name="total_length[]" class="form-control text-right" onkeyup="calculate_store(' + count + ');" onchange="calculate_store(' + count + ');" placeholder="0.00" ></td> <td><input type="text" id="product_rate_' + count + '" name="product_rate[]" class="form-control text-right" onkeyup="calculate_store(' + count + ');" onchange="calculate_store(' + count + ');" placeholder="0.00" ></td>  <td><input type="text" id="total_price_' + count + '" name="total_price[]' + count + '" class="form-control text-right total_price stock_ctn_1" placeholder="0.00" readonly></td><td><button type="button" onclick="deleteRow(this)" class="delete-count btn btn btn-danger text-right red valid" value="Delete" aria-invalid="false" tabindex="8"><i class="fas fa-times"></i></button></td>';
        document.getElementById(divName).appendChild(newdiv);
        // document.getElementById(tabin).focus();
        // document.getElementById("add_invoice_item").setAttribute("tabindex", tab5);
        // document.getElementById("add_purchase").setAttribute("tabindex", tab6);
        count++;

        $("select.form-control:not(.dont-select-me)").select2({
            placeholder: "Select option",
            allowClear: true
        });
    }
}

function bags_count(sl) {

    console.log("hi bags count here");

}

// Counts and limit for purchase order


//Calculate store product
"use strict";

function calculate_store(sl) {

    var beam = 0;
    var ttl_length = 0;
    var beam = $("#beam_" + sl).val();
    var givenlength = $("#available_quantity_" + sl).val();
    var length_per_beam = $("#length_per_beam_" + sl).val();
    ttl_length = beam * length_per_beam;
    
    if (ttl_length > givenlength) {
        alert('Given Length exceded the Available Lenght!');
        return false;
    }
    $("#total_length_" + sl).val(ttl_length);

}

"use strict";

function calculate_amount(sl) {
    var rate = $("#rate_" + sl).val();
    var weight = $("#weight_" + sl).val();
    var amount = rate * weight;
    console.log(rate + ":" + weight);
    $("#amount_" + sl).val(amount);
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
            var available_quantity = 'available_quantity_' + sr_no;

            var form2Data = {
                product_id: ui.item.value,
                supplier_id: supplier_id
            };
            var ajax2url = '/dashboard/textile/retrieve_issue_sizing_data';

            $.ajax({
                type: type,
                url: base_url + ajax2url,
                data: form2Data,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#' + available_quantity).val(data.sizing_amount);
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


"use strict";

function product_pur_or_list_west(sl) {

    var base_url = $('#base_url').val();
    var csrf_test_name = $('[name="csrf_test_name"]').val();


    // Auto complete
    var options = {
        minLength: 0,
        source: function(request, response) {
            var product_name = $('#product_name_' + sl).val();
            $.ajax({
                url: base_url + "purchase/purchase/bdtask_product_search_by_supplier",
                method: 'post',
                dataType: "json",
                data: {
                    term: request.term,
                    product_name: product_name,
                    csrf_test_name: csrf_test_name
                },
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

            var product_id = ui.item.value;


            var base_url = $('.baseUrl').val();


            // var available_quantity = 'available_quantity_' + sl;
            var product_rate = 'product_rate_' + sl;




            $.ajax({
                type: "POST",
                url: base_url + "purchase/purchase/bdtask_retrieve_product_data_west",
                data: { product_id: product_id, csrf_test_name: csrf_test_name },
                cache: false,
                success: function(data) {
                    // alert("hel");
                    console.log(data);
                    obj = JSON.parse(data);
                    // $('#' + available_quantity).val(obj.total_product);
                    // $('#' + product_rate).val(obj.supplier_price);

                }
            });

            $(this).unbind("change");
            return false;
        }
    }

    $('body').on('keypress.autocomplete', '.product_name', function() {
        $(this).autocomplete(options);
    });

}



"use strict";

function bank_paymet(val) {
    if (val == 2) {
        var style = 'block';
        document.getElementById('bank_id').setAttribute("required", true);
    } else {
        var style = 'none';
        document.getElementById('bank_id').removeAttribute("required");
    }

    document.getElementById('bank_div').style.display = style;
}

$(document).ready(function() {
    var paytype = $("#editpayment_type").val();
    if (paytype == 2) {
        $("#bank_div").css("display", "block");
    } else {
        $("#bank_div").css("display", "none");
    }

    $(".bankpayment").css("width", "100%");
});


$(document).ready(function() {
    "use strict";
    var csrf_test_name = $('#CSRF_TOKEN').val();
    var total_purchase_no = $("#total_purchase_no").val();
    var base_url = $("#base_url").val();
    var currency = $("#currency").val();
    var purchasedatatable = $('#PurList').DataTable({
        responsive: true,

        "aaSorting": [
            [4, "desc"]
        ],
        "columnDefs": [
            { "bSortable": false, "aTargets": [0, 1, 2, 3, 5, 6] },

        ],
        'processing': true,
        'serverSide': true,


        'lengthMenu': [
            [10, 25, 50, 100, 250, 500, total_purchase_no],
            [10, 25, 50, 100, 250, 500, "All"]
        ],

        dom: "'<'col-sm-4'l><'col-sm-4 text-center'><'col-sm-4'>Bfrtip",
        buttons: [{
            extend: "copy",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5] //Your Colume value those you want
            },
            className: "btn-sm prints"
        }, {
            extend: "csv",
            title: "PurchaseLIst",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5] //Your Colume value those you want print
            },
            className: "btn-sm prints"
        }, {
            extend: "excel",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5] //Your Colume value those you want print
            },
            title: "PurchaseLIst",
            className: "btn-sm prints"
        }, {
            extend: "pdf",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5] //Your Colume value those you want print
            },
            title: "PurchaseLIst",
            className: "btn-sm prints"
        }, {
            extend: "print",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5] //Your Colume value those you want print
            },
            title: "<center> PurchaseLIst</center>",
            className: "btn-sm prints"
        }],


        'serverMethod': 'post',
        'ajax': {
            'url': base_url + 'purchase/purchase/CheckPurchaseList',
            "data": function(data) {
                data.fromdate = $('#from_date').val();
                data.todate = $('#to_date').val();
                data.csrf_test_name = csrf_test_name;

            }
        },
        'columns': [
            { data: 'sl' },
            { data: 'chalan_no' },
            { data: 'purchase_id' },
            { data: 'supplier_name' },
            { data: 'purchase_date' },
            { data: 'total_amount', class: "total_sale text-right", render: $.fn.dataTable.render.number(',', '.', 2, currency) },
            { data: 'button' },
        ],

        "footerCallback": function(row, data, start, end, display) {
            var api = this.api();
            api.columns('.total_sale', {
                page: 'current'
            }).every(function() {
                var sum = this
                    .data()
                    .reduce(function(a, b) {
                        var x = parseFloat(a) || 0;
                        var y = parseFloat(b) || 0;
                        return x + y;
                    }, 0);
                $(this.footer()).html(currency + ' ' + sum.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            });
        }


    });


    $('#btn-filter').click(function() {
        purchasedatatable.ajax.reload();
    });

});