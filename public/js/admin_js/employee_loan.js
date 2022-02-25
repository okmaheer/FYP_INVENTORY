let employeeSalary = 0;
let applicableLoan = 0;

function getLoanAmount() {
    let employee_id = $('#employee_id').val();

    $.ajax({
        type: 'POST',
        data: {'employee_id': employee_id},
        url: base_url + "/dashboard/get_applicable_loan",
        success: function (result) {
            if (result.success === true) {
                $('#loan_amount_display').val(result.loan_amount_display);
                $('#loan_amount').val(result.loan_amount);

                applicableLoan = Number(result.loan_amount);
                employeeSalary = Number(result.salary);

                $('.loan-row').show('slow');
                $('#return_type').attr('required', true);
                calculateReturnAmount();
                $('#btn_save').attr('disabled', false);
            } else {
                $('.loan-row').hide('slow');
                $('#loan_amount').val('');
                $('#return_type').attr('required', false);
                toastr.error(result.msg);

                $('#btn_save').attr('disabled', true);
            }
        }
    });
}

function getLoanReceiveData() {
    let employee_id = $('#employee_id').val();
    $.ajax({
        type: 'POST',
        data: {'employee_id': employee_id},
        url: base_url + "/dashboard/get_loan_receive_data",
        success: function (result) {
            if (result.success === true) {
                $('#loan_amount_display').val(result.loan_amount_display);
                $('#loan_amount').val(result.loan_amount);
                $('#amount_received').val('');
                $('#amount_received').attr('max', result.loan_amount);
                $('#amount_received').attr('required', true);

                $('.loan-row').show('slow');
                $('#btn_save').attr('disabled', false);
                $('#btn_save_print').attr('disabled', false);
            } else {
                $('.loan-row').hide('slow');
                toastr.error(result.msg);
                $('#btn_save').attr('disabled', true);
                $('#btn_save_print').attr('disabled', true);
                $('#amount_received').attr('required', false);
            }
        }
    });
}

function loanReceiveCalculation() {
    let total_loan = Number($('#loan_amount').val());
    let received_amount = Number($('#amount_received').val());

    if (received_amount > total_loan) {
        toastr.error('Received amount can not be grater than loan amount.');
        $('#amount_received').val('');
        $('#loan_remain').val('0.00');
        return false;
    }
    $('#loan_remain').val(total_loan - received_amount);
}

function applyReturnCondition() {
    let return_type = $('#return_type').val();
    if (return_type === '1') { //on time return
        $('#return_date').attr('required', true);
        $('#deduct_type').attr('required', false);
        $('#deduct_value').attr('required', false);
        $('.all-return').show('slow');
        $('.salary-deduct').hide('slow');
    } else if (return_type === '2') { //salary deduction
        $('#return_date').attr('required', false);
        $('#deduct_type').attr('required', true);
        $('#deduct_value').attr('required', true);
        $('.all-return').hide('slow');
        $('.salary-deduct').show('slow');
    }
    calculateReturnAmount();
}

function calculateReturnAmount() {
    let return_type = $('#return_type').val();

    if (return_type === '1') { //on time return
        $('#deduct_amount').val(applicableLoan);

    } else if (return_type === '2') { //salary deduction
        let deduct_type = $('#deduct_type').val();
        let return_amount = 0;

        if (deduct_type === '1') { //Fixed
            return_amount = Number($('#deduct_value').val());

        } else if (deduct_type === '2') { //Percentage
            return_amount = ((applicableLoan * Number($('#deduct_value').val())) / 100);
        }
        $('#deduct_amount').val(return_amount);
    }
}

$('#loan_details_modal').on('show.bs.modal', function (e) {
    let route = base_url + '/dashboard/get_loan_details';
    $('#loan_details_modal').modal().find('.modal-content').load(route, {'loan_id': $(e.relatedTarget).attr('rec-id')});
});
$('#loan_details_modal').on('shown.bs.modal', function (e) {
    $('#status').select2();
});

$(document).on('submit', 'form#loan_details_form', function(e) {
    e.preventDefault();
    $('#loan_details_modal').modal('hide');

    swal.fire({
        html: 'Please Wait!<br>Processing Request...',
        allowOutsideClick: () => !swal.isLoading()
    });
    swal.showLoading();

    let form = $(this);
    let data = form.serialize();

    $.ajax({
        method: 'POST',
        url: form.attr('action'),
        dataType: 'json',
        data: data,
        success: function(result) {
            if (result.success === true) {
                window.location.reload();
            } else {
                swal.close();
                toastr.error(result.msg);
            }
        },
    });
});

function payLoan(loan_id) {
    swal.fire({
        title: "Do you really want to proceed?",
        type: "question",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: 'Yes! Pay Now',
        confirmButtonColor: '#00a5bb',
        cancelButtonColor: '#f82269',

    }).then((result) => {
        if (result.value === true) {
            swal.fire({
                html: 'Please Wait!<br>Processing Request...',
                allowOutsideClick: () => !swal.isLoading()
            });
            swal.showLoading();

            $.ajax({
                type: 'POST',
                data: {'loan_id': loan_id},
                url: base_url + "/dashboard/pay_loan",
                success: function (result) {
                    if (result.success === true) {
                        swal.close();
                        window.open((base_url + '/dashboard/accounts/payment/receipt?type=LoanPay&VNo=' + result.VNo), '_blank');
                        window.location.reload();
                    } else {
                        swal.close();
                        toastr.error(result.msg);
                    }
                }
            });
        }
    });
}
