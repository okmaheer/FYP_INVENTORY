$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('submit', 'form#setting_general_form', function(e) {
        e.preventDefault();
        swal.fire({
            html: 'Please Wait!<br>Processing Request...',
            allowOutsideClick: () => !swal.isLoading()
        });
        swal.showLoading();

        var form = $(this);
        var data = new FormData(this);

        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            enctype: 'multipart/form-data',
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
            success: function(result) {
                swal.close();
                if (result.success == true) {
                    toastr.success(result.msg);
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $(document).on('submit', 'form#setting_prefix_form', function(e) {
        e.preventDefault();

        swal.fire({
            html: 'Please Wait!<br>Processing Request...',
            allowOutsideClick: () => !swal.isLoading()
        });
        swal.showLoading();

        var form = $(this);
        var data = form.serialize();

        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            success: function(result) {
                swal.close();
                if (result.success == true) {
                    toastr.success(result.msg);
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

});

function __disable_submit_button(element) {
    element.attr('disabled', true);
}

function __enable_submit_button(element) {
    element.attr('disabled', false);
}
