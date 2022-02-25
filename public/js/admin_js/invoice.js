let tax_type = 0;
let tax_value = 0;

//Add Input Field Of Row
"use strict";

function addInputField_invoice(t) {
    var row = $("#normalinvoice tbody tr").length;
    var count = row + 1;
    var tab1 = 0;
    var tab2 = 0;
    var tab3 = 0;
    var tab4 = 0;
    var tab5 = 0;
    var tab6 = 0;
    var tab7 = 0;
    var tab8 = 0;
    var tab9 = 0;
    var tab10 = 0;
    var tab11 = 0;
    var tab12 = 0;
    var limits = 500;
    var taxnumber = $("#txfieldnum").val();
    var tbfild = '';
    for (var i = 0; i < taxnumber; i++) {
        var taxincrefield = '<input id="total_tax' + i + '_' + count + '" class="total_tax' + i + '_' + count + '" type="hidden"><input id="all_tax' + i + '_' + count + '" class="total_tax' + i + '" type="hidden" name="tax[]">';
        tbfild += taxincrefield;
    }
    if (count == limits)
        alert("You have reached the limit of adding " + count + " inputs");
    else {
        var a = "product_name_" + count,
            tabindex = count * 6,
            e = document.createElement("tr");
        tab1 = tabindex + 1;
        tab2 = tabindex + 2;
        tab3 = tabindex + 3;
        tab4 = tabindex + 4;
        tab5 = tabindex + 5;
        tab6 = tabindex + 6;
        tab7 = tabindex + 7;
        tab8 = tabindex + 8;
        tab9 = tabindex + 9;
        tab10 = tabindex + 10;
        tab11 = tabindex + 11;
        tab12 = tabindex + 12;
        e.innerHTML = "<td><input type='text' name='product_name' onkeypress='invoice_productList(" + count + ");' class='form-control product_name common_product' placeholder='Product Name' id='" + a + "' required tabindex='" + tab1 + "' autocomplete='off'><input type='hidden' class='common_product autocomplete_hidden_value  product_id_" + count + "' name='product_id[]' id='SchoolHiddenId'/></td><td><input type='text' name='desc[]'' class='form-control text-right ' tabindex='" + tab2 + "'/></td><td><input type='text' name='available_quantity[]' id='available_quantity_" + count + "' class='form-control text-right common_avail_qnt available_quantity_" + count + "' value='0' readonly tabindex='-1'/></td><td> <input type='number' step='any' min='1' autocomplete='off' name='product_quantity[]' required='required' onkeyup='invoice_quantity_calculate(" + count + ");' onchange='invoice_quantity_calculate(" + count + ");' id='total_qntt_" + count + "' class='common_qnt total_qntt_" + count + " form-control text-right'  placeholder='0.00' min='0' tabindex='" + tab3 + "'/></td><td><input type='number' step='any' min='1' autocomplete='off' name='product_rate[]' onkeyup='invoice_quantity_calculate(" + count + ");' onchange='invoice_quantity_calculate(" + count + ");' id='price_item_" + count + "' class='common_rate price_item" + count + " form-control text-right' required placeholder='0.00' min='0' tabindex='" + tab4 + "'/><input type='hidden' name='supplier_rate[]' id='supplier_rate_" + count + "'/></td><td><input type='number' step='any' min='0' autocomplete='off' name='discount[]' onkeyup='invoice_quantity_calculate(" + count + ");' onchange='invoice_quantity_calculate(" + count + ");' id='discount_" + count + "' class='form-control text-right common_discount' placeholder='0.00' min='0' tabindex='" + tab5 + "' /><input type='hidden' value='' name='discount_type' id='discount_type_" + count + "'></td><td class= 'text-right'><input class='form-control text-right' type='number' step='any' min='0' autocomplete='off' name='tax_p[]' id='tax_" + count + "'onkeyup='invoice_quantity_calculate(" + count + ");' onchange='invoice_quantity_calculate(" + count + ");'></td><td class='text-right'><input class='common_total_price total_price form-control text-right' type='text' name='total_price[]' id='total_price_" + count + "' value='0.00' readonly tabindex='-1'/></td><td>" + tbfild + "<input type='hidden' id='all_discount_" + count + "' class='total_discount dppr' name='discount_amount[]'/><input type='hidden' id='all_tax_" + count + "' class='total_tax ' name='tax_amount[]'/><button tabindex='" + tab5 + "' style='text-align: right;' class='btn btn-danger' type='button' value='Delete' onclick='deleteRow_invoice(this)'><i class='fas fa-times'></i></button></td>",
            document.getElementById(t).appendChild(e),
            document.getElementById(a).focus(),
            document.getElementById("add_invoice_item").setAttribute("tabindex", tab6);
        // document.getElementById("details").setAttribute("tabindex", tab7);
        document.getElementById("invoice_discount").setAttribute("tabindex", tab8);
        document.getElementById("shipping_cost").setAttribute("tabindex", tab9);
        document.getElementById("paidAmount").setAttribute("tabindex", tab10);
        // document.getElementById("full_paid_tab").setAttribute("tabindex", tab11);
        // document.getElementById("add_invoice").setAttribute("tabindex", tab12);
        count++
    }
}


"use strict";

function invoice_quantity_calculate(item) {
    var quantity = $("#total_qntt_" + item).val();
    var available_quantity = $(".available_quantity_" + item).val();
    var price_item = $("#price_item_" + item).val();
    var invoice_discount = $("#invoice_discount").val();
    var discount = $("#discount_" + item).val();
    var tax = $("#tax_" + item).val();
    var total_discount = $("#total_discount_" + item).val();
    var dis_type = 1;

    // /* Turn this block on when inventory module is active

    if (parseInt(quantity) > parseInt(available_quantity)) {
        var message = "You can Sale maximum " + available_quantity + " Items";
        // toastr["error"](message);
        alert(message);
        $("#total_qntt_" + item).val('');
        var quantity = 0;
        $("#total_price_" + item).val(0);

    }

    if (quantity > 0 || discount > 0 || tax) {
        if (dis_type == 1) {
            var price = quantity * price_item;
            var tax = +(price * tax / 100);
            var discount_price = quantity * price_item +tax;


            var dis = +(discount_price * discount / 100);

            $("#all_discount_" + item).val(dis);
            $("#all_tax_" + item).val(tax);
            //Total price calculate per product
            var temp = price - dis + tax;
            $("#total_price_" + item).val(temp);


        } else if (dis_type == 2) {
            var price = quantity * price_item;

            // Discount cal per product
            var dis = (discount * quantity);

            $("#all_discount_" + item).val(dis);

            //Total price calculate per product
            var temp = price - dis;
            $("#total_price_" + item).val(temp);


        } else if (dis_type == 3) {
            var total_price = quantity * price_item;
            var dis = discount;
            // Discount cal per product
            $("#all_discount_" + item).val(dis);
            //Total price calculate per product
            var price = total_price - dis;
            $("#total_price_" + item).val(price);


        }
    } else {
        var n = quantity * price_item;
        // var c = quantity * price_item * total_tax;
        $("#total_price_" + item).val(n)
    }
    var t = 0;
    $(".total_price").each(function() {
        isNaN(this.value) || 0 == this.value.length || (t += parseFloat(this.value))
    });
    e = t.toFixed(2);
    var test = e;
      $("#grandTotal").val(test);


    invoice_calculateSum();
    invoice_paidamount();
}

//Calculate Sum
"use strict";

function invoice_calculateSum() {
    // var taxnumber = $("#txfieldnum").val();
    var t = 0,
        a = 0,
        e = 0,
        o = 0,
        p = 0,
        f = 0,
        ad = 0,
        tx = 0,
        ds = 0,
        s_cost = $("#shipping_cost").val();

    //Total Discount
    $(".total_discount").each(function () {
        isNaN(this.value) || 0 == this.value.length || (p += parseFloat(this.value))
    }),
        $("#total_discount_ammount").val(p.toFixed(2, 2)),

        //Total Price
        $(".total_price").each(function () {
            isNaN(this.value) || 0 == this.value.length || (t += parseFloat(this.value))
        }),

        $(".dppr").each(function () {
            isNaN(this.value) || 0 == this.value.length || (ad += parseFloat(this.value))
        }),

        o = a.toFixed(2),
        e = t.toFixed(2),
        tx = f.toFixed(2),
        ds = p.toFixed(2);

        var test = +tx + +s_cost + +e + -ds + +ad;

    console.log(tx);
    console.log(tx);
    console.log(s_cost);
    console.log(e);
        console.log(ds);
        console.log(ad);



    var invdis = $("#invoice_discount").val();
    var total_discount_ammount = $("#total_discount_ammount").val();
    var ttl_discount = +total_discount_ammount;
    $("#total_discount_ammount").val(ttl_discount.toFixed(2));
    // invoice_paidamount();

    let net_total = test;
    let tax_amount = 0;

    if (tax_type === 2) { //tax in percent
        tax_amount = Number(((test * tax_value) / 100));
    } else { //fix tax
        tax_amount = Number(tax_value);
    }
    $('#total_tax').val(tax_amount.toFixed(2));

    net_total = test + tax_amount;
    $("#n_total").val(net_total);

    var paid_amount = Number($("#paidAmount").val());
    var due_amount = net_total - paid_amount;

    if (paid_amount > net_total) {
        $('#change').val((paid_amount - net_total).toFixed(2));
        $('#dueAmmount').val('0.00');
    } else {
        $('#change').val('0.00');
        $('#dueAmmount').val(due_amount.toFixed(2));
    }
}

//Invoice Paid Amount
"use strict";

function invoice_paidamount() {
    var prb = parseFloat($("#previous").val());
    var pr = 0;
    var d = 0;
    var nt = 0;
    if (prb != 0) {
        pr = prb;
    } else {
        pr = 0;
    }
    var t = $("#grandTotal").val(),
        a = $("#paidAmount").val(),
        e = t - a,
        f = e + pr,
        nt = parseFloat(t) + pr;
    d = a - nt;
    // $("#n_total").val(nt.toFixed(2));
    if (f > 0) {
        $("#dueAmmount").val(f.toFixed(2));
        if (a <= f) {
            $("#change").val(0);
        }
    } else {
        if (a < f) {
            $("#change").val(0);
        }
        if (a > f) {
            $("#change").val(d.toFixed(2, 2))
        }
        $("#dueAmmount").val(0)

    }
}

//Stock Limit
"use strict";

function stockLimit(t) {
    var a = $("#total_qntt_" + t).val(),
        e = $(".product_id_" + t).val(),
        o = $(".baseUrl").val();

    $.ajax({
        type: "POST",
        url: o + "Cinvoice/product_stock_check",
        data: {
            product_id: e
        },
        cache: !1,
        success: function (e) {
            alert(e);
            if (a > Number(e)) {
                var o = "You can Sale maximum " + e + " Items";
                alert(o), $("#qty_item_" + t).val("0"), $("#total_qntt_" + t).val("0"), $("#total_price_" + t).val("0")
            }
        }
    })
}


//Invoice full paid
"use strict";

function invoicee_full_paid() {
    var grandTotal = $("#n_total").val();
    $("#paidAmount").val(grandTotal);
    invoice_paidamount();
    invoice_calculateSum();
}

//Delete a row of table
"use strict";

function deleteRow_invoice(t) {
    var a = $("#normalinvoice > tbody > tr").length;
    if (1 == a)
        alert("There only one row you can't delete.");
    else {
        var e = t.parentNode.parentNode;
        e.parentNode.removeChild(e),
            invoice_calculateSum();
        invoice_paidamount();
        var current = 1;
        $("#normalinvoice > tbody > tr td input.productSelection").each(function () {
            current++;
            $(this).attr('id', 'product_name' + current);
        });
        var common_qnt = 1;
        $("#normalinvoice > tbody > tr td input.common_qnt").each(function () {
            common_qnt++;
            $(this).attr('id', 'total_qntt_' + common_qnt);
            $(this).attr('onkeyup', 'invoice_quantity_calculate(' + common_qnt + ');');
            $(this).attr('onchange', 'invoice_quantity_calculate(' + common_qnt + ');');
        });
        var common_rate = 1;
        $("#normalinvoice > tbody > tr td input.common_rate").each(function () {
            common_rate++;
            $(this).attr('id', 'price_item_' + common_rate);
            $(this).attr('onkeyup', 'invoice_quantity_calculate(' + common_qnt + ');');
            $(this).attr('onchange', 'invoice_quantity_calculate(' + common_qnt + ');');
        });
        var common_discount = 1;
        $("#normalinvoice > tbody > tr td input.common_discount").each(function () {
            common_discount++;
            $(this).attr('id', 'discount_' + common_discount);
            $(this).attr('onkeyup', 'invoice_quantity_calculate(' + common_qnt + ');');
            $(this).attr('onchange', 'invoice_quantity_calculate(' + common_qnt + ');');
        });
        var common_total_price = 1;
        $("#normalinvoice > tbody > tr td input.common_total_price").each(function () {
            common_total_price++;
            $(this).attr('id', 'total_price_' + common_total_price);
        });


    }
}

var count = 2,
    limits = 500;


"use strict";

function bank_info_show(payment_type) {
    if (payment_type.value == "1") {
        document.getElementById("bank_info_hide").style.display = "none";
    } else {
        document.getElementById("bank_info_hide").style.display = "block";
    }
}


window.onload = function () {
    $('body').addClass("sidebar-mini sidebar-collapse");
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

$(document).ready(function () {
    $('#normalinvoice .toggle').on('click', function () {
        $('#normalinvoice .hideableRow').toggleClass('hiddenRow');
    })
});

"use strict";

function customer_due(id) {
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = $("#base_url").val();
    $.ajax({
        url: base_url + 'invoice/invoice/previous',
        type: 'post',
        data: {customer_id: id, csrf_test_name: csrf_test_name},
        success: function (msg) {

            $("#previous").val(msg);
        },
        error: function (xhr, desc, err) {
            alert('failed');
        }
    });
}


"use strict";

function customer_autocomplete(sl) {

    var customer_id = $('#customer_id').val();
    // Auto complete
    var options = {
        minLength: 0,
        source: function (request, response) {
            var customer_name = $('#customer_name').val();
            var csrf_test_name = $('[name="csrf_test_name"]').val();
            var base_url = $("#base_url").val();

            $.ajax({
                url: base_url + "invoice/invoice/bdtask_customer_autocomplete",
                method: 'post',
                dataType: "json",
                data: {
                    term: request.term,
                    customer_id: customer_name,
                    csrf_test_name: csrf_test_name,
                },
                success: function (data) {
                    response(data);

                }
            });
        },
        focus: function(event, ui) {
            // $(this).val(ui.item.label);
            return false;
        },
        select: function (event, ui) {
            $(this).parent().parent().find("#autocomplete_customer_id").val(ui.item.value);
            var customer_id = ui.item.value;
            customer_due(customer_id);

            $(this).unbind("change");
            return false;
        }
    }

    $('body').on('keypress.autocomplete', '#customer_name', function () {
        $(this).autocomplete(options);
    });

}

"use strict";

function cancelprint() {
    location.reload();
}

$(document).ready(function () {

    $('#full_paid_tab').keydown(function (event) {
        if (event.keyCode == 13) {
            $('#add_invoice').trigger('click');
        }
    });
});


$(document).ready(function () {
    "use strict";
    var frm = $("#insert_sale");
    var output = $("#output");
    frm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            dataType: 'json',
            data: frm.serialize(),
            success: function (data) {

                if (data.status == true) {
                    toastr["success"](data.message);
                    swal({
                        title: "Success!",
                        showCancelButton: true,
                        cancelButtonText: "NO",
                        confirmButtonText: "Yes",
                        text: "Do You Want To Print ?",
                        type: "success",


                    }, function (inputValue) {
                        if (inputValue === true) {
                            $("#normalinvoice tbody tr").remove();
                            $('#insert_sale').trigger("reset");

                            printRawHtml(data.details);
                        } else {
                            location.reload();
                        }

                    });
                    if (data.status == true && event.keyCode == 13) {
                    }
                } else {
                    toastr["error"](data.exception);
                }
            },
            error: function (xhr) {
                alert('failed!');
            }
        });
    });
});

$(document).ready(function () {
    "use strict";
    var frm = $("#update_invoice");
    var output = $("#output");
    frm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            dataType: 'json',
            data: frm.serialize(),
            success: function (data) {

                if (data.status == true) {
                    toastr["success"](data.message);
                    $("#inv_id").val(data.invoice_id);
                    $('#printconfirmodal').modal('show');
                    if (data.status == true && event.keyCode == 13) {
                    }
                } else {
                    toastr["error"](data.exception);
                }
            },
            error: function (xhr) {
                alert('failed!');
            }
        });
    });
});

$("#printconfirmodal").on('keydown', function (e) {
    var key = e.which || e.keyCode;
    if (key == 13) {
        $('#yes').trigger('click');
    }
});


"use strict";

function invoice_productList(sl) {

    var sr_no = sl;
    var priceClass = 'price_item' + sl;
    var available_quantity = 'available_quantity_' + sl;
    var unit = 'unit_' + sl;
    var tax = 'total_tax_' + sl;
    var serial_no = 'serial_no_' + sl;
    var discount_type = 'discount_type_' + sl;
    var customer_id = $('#customer_id').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    var type = "POST";

    // Auto complete
    var options = {
        minLength: 0,
        source: function (request, response) {
            // var product_name = $('#product_name_'+sl).val();
            var formData = {
                'product_name': $('#product_name_' + sl).val(),
                'type': 'sale'
            };
            var ajaxurl = '/product_autocomplete';
            $.ajax({
                type: type,
                url: base_url + ajaxurl,
                data: formData,
                dataType: 'json',
                success: function (data) {
                    response(data);
                }
            });
        },
        focus: function( event, ui ) {
            // $(this).val(ui.item.label);
            return false;
        },
        select: function( event, ui ) {
            var total_rows = $("#normalinvoice tbody tr").length;
            var i = 0;
            var product_id = 0;
            var product_in_list = false;

            for (i; i <= total_rows; i++) {
                product_id = $('.product_id_' + i).val();
                if (product_id == ui.item.value) {
                    product_in_list = true;
                    break;
                }
            }

            if (product_in_list == true) {
                alert('Product is already in list.');
                $('#product_name_' + i).focus();
                return false;
            } else {
                $(this).parent().parent().find(".autocomplete_hidden_value").val(ui.item.value);
                $(this).val(ui.item.label);

                var available_quantity = 'available_quantity_' + sr_no;
                var priceClass = 'price_item_' + sr_no;
                var supplierRate = 'supplier_rate_' + sr_no;

                // console.log(priceClass + " priceClass");

                var id = ui.item.value;
                var dataString = 'product_id=' + id;
                var form2Data = {
                    product_id: ui.item.value,
                };
                var ajax2url = '/retrieve_product_data';
                $.ajax({
                    type: type,
                    url: base_url + ajax2url,
                    data: form2Data,
                    dataType: 'json',
                    success: function (data) {
                        // response( data );
                        $('#' + available_quantity).val(data.total_product);
                        $('#' + priceClass).val(data.price);
                        $('#' + supplierRate).val(data.supplier_price);
                    }
                });
                // $.ajax
                // ({
                //     type: "POST",
                //     url: base_url+"invoice/invoice/retrieve_product_data_inv",
                //     data: {product_id:id,csrf_test_name:csrf_test_name},
                //     cache: false,
                //     success: function(data)
                //     {
                //         var obj = jQuery.parseJSON(data);
                //         for (var i = 0; i < (obj.txnmber); i++) {
                //             var txam = obj.taxdta[i];
                //             var txclass = 'total_tax'+i+'_'+sl;
                //             $('.'+txclass).val(obj.taxdta[i]);
                //         }
                //         $('.'+priceClass).val(obj.price);
                //         $('.'+available_quantity).val(obj.total_product.toFixed(2,2));
                //         $('.'+unit).val(obj.unit);
                //         $('.'+tax).val(obj.tax);
                //         $('#txfieldnum').val(obj.txnmber);
                //         $('#'+serial_no).html(obj.serial);
                //
                //         invoice_quantity_calculate(sl);
                //
                //     }
                // });

                $(this).unbind("change");
                return false;
            }
        }
    }
    $('body').on('keypress.autocomplete', '.product_name', function () {
        $(this).autocomplete(options);
    });

}

$(document).ready(function () {
    "use strict";
    var paytype = $("#editpayment_type").val();
    if (paytype == 2) {
        $("#bank_div").css("display", "block");
    } else {
        $("#bank_div").css("display", "none");
    }

    $(".bankpayment").css("width", "100%");
});

"use strict"

function select_employ(elem) {
    // alert();
    var base_url = $('.baseUrl').val();
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var id = elem;
    $.ajax({
        type: "POST",
        url: "get_employ",
        data: {employ_id: id, csrf_test_name: csrf_test_name},
        cache: false,
        success: function (data) {
            // alert(data);
            $("#salary_input").val(data);
        }
    });
}

"use strict"

function advance_infot(elem) {
    var salary_input = $("#salary_input").val();
    var advance_data = elem.value;
    var total = salary_input - advance_data;
    $(".remaning_amount").val(total);
}

function getTaxValue(cElement) {
    let oid = $(cElement).val();

    $.ajax({
        type: 'POST',
        url: base_url + "/api/get_tax_details" + "?taxID=" + oid,
        success: function (result) {
            if (result.success === true) {
                result.data;
                tax_type = result.data.tax_type;
                tax_value = result.data.tax_value;

                invoice_calculateSum();
            } else {
                tax_type = 0;
                tax_value = 0;
                invoice_calculateSum();
            }
        }
    });
}
