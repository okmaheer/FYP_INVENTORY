function LogoutConfirm() {
    swal.fire({
        title: "Do you really want to log out of current user account?",
        type: "question",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: 'Yes! Logout',
        confirmButtonColor: '#00a5bb',
        cancelButtonColor: '#f82269',
        allowOutsideClick: () => {
            const popup = swal.getPopup();
            popup.classList.remove('swal2-show');
            setTimeout(() => {
                popup.classList.add('headShake', 'animated');
            })
            setTimeout(() => {
                popup.classList.remove('headShake', 'animated');
            }, 500);
            return false;
        }
    }).then((result) => {
        if (result.value === true) {
            $('#logoutForm').submit();
        }
    });
}

function DeleteEntry(recID) {
    swal.fire({
        title: "Do you really want to remove this record?",
        type: "question",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: 'Yes! Delete',
        confirmButtonColor: '#00a5bb',
        cancelButtonColor: '#f82269',
        allowOutsideClick: () => {
            const popup = swal.getPopup();
            popup.classList.remove('swal2-show');
            setTimeout(() => {
                popup.classList.add('headShake', 'animated');
            })
            setTimeout(() => {
                popup.classList.remove('headShake', 'animated');
            }, 500);
            return false;
        }
    }).then((result) => {
        if (result.value === true) {
            $('#deleteForm'+recID).submit();
        }
    });
}

function ResetForm(urlToReset) {
    swal.fire({
        title: "Do you really want to reset this form?",
        type: "question",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: 'Yes! Reset Form',
        confirmButtonColor: '#00a5bb',
        cancelButtonColor: '#f82269',
        allowOutsideClick: () => {
            const popup = swal.getPopup();
            popup.classList.remove('swal2-show');
            setTimeout(() => {
                popup.classList.add('headShake', 'animated');
            })
            setTimeout(() => {
                popup.classList.remove('headShake', 'animated');
            }, 500);
            return false;
        }

    }).then((result) => {
        if (result.value === true) {
            window.location.replace(urlToReset);
        }
    });
}

function SubmitAndPrint(form_id_to_submit) {
    $("#doPrint").val('1');
    $("#"+form_id_to_submit).submit();
}

function SubmitAndNew(form_id_to_submit) {
    $("#saveNew").val('1');
    $("#"+form_id_to_submit).submit();
}

function FullPayForm(field_paid_amount, field_total_amount) {
    let totalAmount = Number($('#' + field_total_amount).val().replace(/,/g, ''));
    $('#' + field_paid_amount).val(totalAmount).trigger('change');
}

function getSupplierBalance(cElement, field_id_to_display_balance, field_id_to_display_last, parent_id_to_visible) {
    let oid = $(cElement).val();
    $.ajax({
        type: 'POST',
        url: base_url + "/api/supplier_balance?supplierID=" + oid,
        success: function (result) {
            if (result.success === true) {
                $(('#' + field_id_to_display_balance)).html(result.balance);
                if ($('#' + field_id_to_display_last ).length) {
                    $('#' + field_id_to_display_last).html(result.last);
                }
                $(('#' + parent_id_to_visible)).show();
            } else {
                toastr.error(result.msg);
            }
        }
    });
}

function getAccountBalance(cElement, field_id_to_display_balance, field_id_to_display_last, parent_id_to_visible) {
    let oid = $(cElement).val();
    $.ajax({
        type: 'POST',
        url: base_url + "/api/account_balance",
        data: {accountID: oid},
        success: function (result) {
            if (result.success === true) {
                $(('#' + field_id_to_display_balance)).html(result.balance);
                if ($('#' + field_id_to_display_last ).length) {
                    $('#' + field_id_to_display_last).html(result.last);
                }
                $(('#' + parent_id_to_visible)).show();
            } else {
                toastr.error(result.msg);
            }
        }
    });
}

function getCustomerBalance(cElement, field_id_to_display, field_id_to_display_last, parent_id_to_visible) {
    let oid = $(cElement).val();

    $.ajax({
        type: 'POST',
        url: base_url + "/api/customer_balance" + "?customerID=" + oid,
        success: function (result) {
            if (result.success === true) {
                $(('#' + field_id_to_display)).html(result.balance);
                if ($('#' + field_id_to_display_last ).length) {
                    $('#' + field_id_to_display_last).html(result.last);
                }
                $(('#' + parent_id_to_visible)).show();
            } else {
                toastr.error(result.msg);
            }
        }
    });
}

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip({html: true});

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    toastr.options = {
        "progressBar": true,
        "closeButton": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
    }

    $('#printBtn').click(function(){
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = {
            mode: mode,
            popClose: close
        };
        $("div#printArea").printArea(options);
    });
});
