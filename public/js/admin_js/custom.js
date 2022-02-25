(function () {
    $('.datepicker').datepicker({
        format: dateFormat,
        autoclose: true,
        todayHighlight: true,
        todayBtn: "linked",
        orientation: 'bottom',
    });
    $('.monthpicker').datepicker({
        format: "MM-yyyy",
        autoclose: true,
        minViewMode: 1,
        maxViewMode: 2,
        orientation: 'bottom',
    });

    // on first focus (bubbles up to document), open the menu
    $(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
        $(this).closest(".select2-container").siblings('select:enabled').select2('open');
    });

    // steal focus during close - only capture once and stop propagation
    $('select.select2').on('select2:closing', function (e) {
        $(e.target).data("select2").$selection.one('focus focusin', function (e) {
            e.stopPropagation();
        });
    });

    $('.input-group-append').click(function () {
        if ($('.input-group-append').find('span i.fa-calendar-alt').length !== 0) {
            let dateField = $(this).closest('div').parent().find('.datepicker');
            if (dateField.length) {
                $(dateField).focus();
            }
        }
    });

    $('.solid-validation').parsley().on('form:submit', function() {
        swal.fire({
            html: 'Please Wait!<br>Processing Request...',
            allowOutsideClick: () => !swal.isLoading()
        });
        swal.showLoading();
    });
})();
