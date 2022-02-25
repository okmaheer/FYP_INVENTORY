$(document).on('submit', 'form#auto_salary_form', function(e) {
    e.preventDefault();
    var form = $(this);
    var data = form.serialize();

    swal.fire({
        html: 'Please wait!<br>Generating salaries of employees.',
        allowOutsideClick: () => !swal.isLoading()
    });
    swal.showLoading();

    $.ajax({
        method: 'POST',
        url: form.attr('action'),
        dataType: 'json',
        data: data,
        beforeSend: function() {
            $(form.find('button[type="submit"]')).attr('disabled', true);
            $('#generated_salaries').hide('slow');
            $('#view_pay_slips').hide();
        },
        success: function(result) {
            let rows = '';

            if (result.success === true) {
                swal.close();
                $(form.find('button[type="submit"]')).attr('disabled', false);
                $('#view_pay_slips').show();

                $('.gen_month').html(result.month);

                let alreadyRecords = result.alreadyRecords;
                let currentRecords = result.currentRecords;

                $('#body_already').empty();
                if (alreadyRecords.length > 0) {
                    alreadyRecords.forEach(rec=>{
                        rows += '<tr>';
                        rows += '<td>' + rec.employee + '</td><td>' + rec.generated_date + '</td>';
                        rows += '</tr>';
                    })
                    $('#body_already').empty().append(rows);
                }

                $('#body_current').empty();
                if (currentRecords.length > 0) {
                    rows = '';

                    currentRecords.forEach(rec=>{
                        rows += '<tr>';
                        rows += '<td>' + rec.employee + '</td><td>' + rec.generated_date + '</td>';
                        rows += '</tr>';
                    })
                    $('#body_current').empty().append(rows);
                }
                $('#generated_salaries').show('slow');
            } else {
                swal.close();
                toastr.error(result.msg);
            }
        },
    });
});

$('#received_by_modal').on('shown.bs.modal', function (e) {
    $('#received_by').val($(e.relatedTarget).attr('emp-id'));
    $('#received_by').trigger('change');
    $('#salary_id').val($(e.relatedTarget).attr('rec-id'));
});

$(document).on('submit', 'form#salary_payment_form', function(e) {
    e.preventDefault();

    $('#received_by_modal').modal('hide')

    swal.fire({
        html: 'Please Wait!<br>Processing Request...',
        allowOutsideClick: () => !swal.isLoading()
    });
    swal.showLoading();

    var form = $(this);
    var data = form.serialize();

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
                toastr.error(result.msg, 'Error');
            }
        },
    });
});

//onchange empoyee id information
"use strict";
function employechange(id){
    var base_url =  $("#base_url").val();
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    $.ajax({
        url: base_url + "hrm/payroll/employeebasic/",
        method:'post',
        dataType:'json',
        data:{
            'employee_id': id,
            csrf_test_name:csrf_test_name,
        },
        success:function(data){
            document.getElementById('basic').value=data.rate;
            document.getElementById('sal_type').value=data.rate_type;
            document.getElementById('sal_type_name').value=data.stype;
            document.getElementById('grsalary').value=data.rate;
            if(data.rate_type==1){
                document.getElementById("taxinput").disabled = true;
                document.getElementById("taxmanager").checked = true;
                document.getElementById("taxmanager").setAttribute('disabled','disabled');
            }else{
                document.getElementById("taxinput").disabled = false;
                document.getElementById("taxmanager").checked = false;
                document.getElementById("taxmanager").removeAttribute('disabled');
            }
            var i;
            var count = $('#add tr').length;
            for (i = 0; i < count; i++) {
                $("#add_"+i).val('');
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

//check advance against employee id
"use strict";
function employechange_emp_adv_sal(id){

    var date_month = $('input[name$="salary_month"]').val();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: base_url + "/dashboard/accounts/calc/advance/salary/"+id +'/'+ date_month,
        method:'get',
        dataType:'json',
        success:function(data){
            console.log(data);
            if(data.remainingSalary == 0) {
                toastr.warning('Complete salary to selected employee has already been paid.', 'Already Paid')
            } else {
                $('#basic').val(data.basic);
                $('#advance_taken').val(data.advance);
                $('#rem_sal').val(data.remainingSalary);
                $('#temp_rem_sal').val(data.remainingSalary);
                if (Number(data.loan) > 0) {
                    $('#loan').val(data.loan);
                    $('#loan').attr('readonly', false);
                    calculateAfterLoan();
                } else {
                    $('#loan').val('0.00');
                    $('#loan').attr('readonly', true);
                }
                $('#advance').attr('max', data.remainingSalary);
            }
        }
    });
}

"use strict";
function getDailyWage(id) {
    let date = $('#salary_month').val();
    if (date.length == 0 ){
        toastr.info('Please select date first.');
        $('#employee_id').val('');
        return false;
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "get_daily_wage",
        method: 'post',
        dataType: 'json',
        data: {
            'employee_id': id,
            'date': date,
        },
        success: function(data) {
            if (data.success === true) {
                if (data.salary == 0) {
                    toastr.success('Daily wages already paid to selected employee for selected date.');
                    return false;
                }

                $('#total_salary').val(data.salary);
                $('#deduction').attr('max', data.salary);
                calculateDailyWage();
            } else {
                toastr.error('Something went wrong!', 'Error');
            }
        }
    });
}

function calculateDailyWage() {
    let deduct_amount = Number($('#deduction').val());
    let total_salary = Number($('#total_salary').val());
    if (deduct_amount > total_salary) {
        toastr.error('Deduction can not be grater that salary.');
        $('#deduction').val('');
        return false;
    }
    $('#paid_salary').val(total_salary - deduct_amount);
}

"use strict";
function summary(){
    var addper = 0;
    $(".addamount").each(function() {
        isNaN(this.value) || 0 == this.value.length || (addper += parseFloat(this.value))
    });
    if(addper >100){
        alert('You Can Not input more than 100%');
    }
    var b = parseInt($('#basic').val());
    var add = 0;
    var deduct = 0;
    $(".addamount").each(function() {
        var value = this.value;
        var basic = parseInt($('#basic').val());
        isNaN(value*basic/100) || 0 == (value*basic/100).length || (add += parseFloat(value*basic/100))
    });
    $(".deducamount").each(function() {
        var value = this.value;
        var basic = parseInt($('#basic').val());
        isNaN(value*basic/100) || 0 == (value*basic/100).length || (deduct += parseFloat(value*basic/100))
    });
    document.getElementById('grsalary').value=add+b-(deduct);
}


"use strict";
function handletax(checkbox){
    var deduct = 0;
    var add = 0;
    var b = parseInt($('#basic').val());
    $(".deducamount").each(function() {
        var value = this.value;
        var basic = parseInt($('#basic').val());
        isNaN(value*basic/100) || 0 == (value*basic/100).length || (deduct += parseFloat(value*basic/100))
    });
    $(".addamount").each(function() {
        var value = this.value;
        var basic = parseInt($('#basic').val());
        isNaN(value*basic/100) || 0 == (value*basic/100).length || (add += parseFloat(value*basic/100))
    });

    var amount = b-deduct;
    var  tax    = parseInt($('#taxinput').val());
    var netamount = amount+tax;
    var base_url =  $("#base_url").val();
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    if(checkbox.checked == true){
        $.ajax({
            url : base_url +'hrm/payroll/salarywithtax/',
            method: 'post',
            dataType: 'json',
            data:
                {
                    'amount': amount,
                    csrf_test_name:csrf_test_name,
                },
            success: function(data)
            {
                document.getElementById('grsalary').value=add+b-data-deduct;
                document.getElementById('taxinput').value='';
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }else{
        var b = parseInt($('#basic').val());
        var add = 0;
        var deduct = 0;
        $(".addamount").each(function() {
            var value = this.value;
            var basic = parseInt($('#basic').val());
            isNaN(value*basic/100) || 0 == (value*basic/100).length || (add += parseFloat(value*basic/100))
        });
        $(".deducamount").each(function() {
            var value = this.value;
            var basic = parseInt($('#basic').val());
            isNaN(value*basic/100) || 0 == (value*basic/100).length || (deduct += parseFloat(value*basic/100))
        });
        document.getElementById('grsalary').value=add+b-(deduct);
    }
}


$(function() {
    "use strict";
    $('.monthYearPicker').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy'
    }).focus(function() {
        var thisCalendar = $(this);
        $('.ui-datepicker-calendar').detach();
        $('.ui-datepicker-close').click(function() {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            thisCalendar.datepicker('setDate', new Date(year, month, 1));
        });
    });
});


"use strict";
function Payment(salpayid,employee_id,TotalSalary,WorkHour,Period,salary_month){

    var sal_id = salpayid;
    var employee_id = employee_id;
    var base_url =  $("#base_url").val();
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    $.ajax({
        url: base_url + "hrm/payroll/EmployeePayment/",
        method:'post',
        dataType:'json',
        data:{
            'sal_id':sal_id,
            'employee_id':employee_id,
            'totalamount':TotalSalary,
            csrf_test_name:csrf_test_name
        },
        success:function(data){
            document.getElementById('employee_name').value = data.Ename;
            document.getElementById('employee_id').value = data.employee_id;
            document.getElementById('salType').value = salpayid;
            document.getElementById('total_salary').value = TotalSalary;
            document.getElementById('total_working_minutes').value = WorkHour;
            document.getElementById('working_period').value = Period;
            document.getElementById('salary_month').value = salary_month;
            $("#PaymentMOdal").modal('show');
        },
        error:function(jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }

    });
}


function calc_sal_advc(){
    var advance = 0;
    var basic = $('#basic').val();
    var org_sal = $('#org_sal').val();
    var attendance = $('#attendance').val();
    var present = $('#present').val();
    var deduction = $('#deduction').val();
    var sal = 0,att = 0,temp_sal = 0;
    var rate = org_sal/30;
    temp_sal = org_sal - advance;
    temp_sal = (deduction > 0 ) ?  (temp_sal - deduction) : temp_sal;
    // console.log(rate);
    if($("#deduct_select").is(':checked') && attendance > 0 && present  > 0 ){

        att = attendance - present;
        // att = att * rate;
        sal = temp_sal - (att * rate);

        console.log("remaining: " + sal + " att " + att + " rate: "+ rate + " temp_sal: "+ temp_sal  + " basic: "+ basic);




    }
    else{

        sal = temp_sal;

    }

    $('#basic').val(sal);
    $('#total_salary').val(sal);



}

function calculateAfterLoan() {
    let loan = Number($('#loan').val());
    let tempSalary = Number($('#temp_rem_sal').val());

    $('#rem_sal').val(tempSalary - loan);
    calc_advc();
}

function calc_advc(){
    var advance = Number($('#advance').val());
    var rem_sal = Number($('#rem_sal').val());
    var temp = Number($('#temp_rem_sal').val());

    var sal = 0;

    if( advance > rem_sal ){
        toastr.error('Advance can not be greater than remaining salary.', 'Invalid Advance Amount')
        $('#advance').val('');
    } else {
        // sal = rem_sal - advance;
        // $('#rem_sal').val(sal);
    }
}
