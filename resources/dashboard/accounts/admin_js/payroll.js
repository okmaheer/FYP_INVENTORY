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
            document.getElementById('basic').value=data.basic;
            document.getElementById('rem_sal').value=data.remainingSalary;
            document.getElementById('temp_rem_sal').value=data.remainingSalary;

        }
    });
}

"use strict";
function employechange_emp_sal(id) {
    var base_url = $("#base_url").val();
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var date_month = $('input[name$="myDate"]').val();

    //   console.log(date_month + " ajax");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "select_employ",
        method: 'post',
        dataType: 'json',
        data: {
            'employee_id': id,
            'date_month': date_month,
            csrf_test_name: csrf_test_name,
        },
        success: function(data) {

            console.log(data);
            document.getElementById('basic').value = data[0].hrate;

            document.getElementById('org_sal').value = data[0].hrate;
        },

    });
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
    var advance = $('#advance').val();
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

function calc_advc(){
    var advance = $('#advance').val();
    var salary = $('#basic').val();
    var rem_sal = $('#rem_sal').val();
    var temp = $('#temp_rem_sal').val();
    var sal = 0;
    // alert('Advance is Less Than Salary');
    // console.log('advance' + advance + 'sal' + salary)
    console.log( salary + ' : ' + temp); // checked
    if( parseInt(advance) > parseInt(rem_sal) ){
        alert('Advance is Not Greater Than Salary or Remaining Salary');
        $('#advance').val(0),
            $('#rem_sal').val(temp);
    }
    else{

        sal = temp - advance;

        $('#rem_sal').val(sal);

    }



}
