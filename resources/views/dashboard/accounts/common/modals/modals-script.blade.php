<script>
    $(document).on('submit', 'form#supplier_ajax_form', function(e) {
        e.preventDefault();
        var form = $(this);
        var data = form.serialize();

        $.ajax({
            method: 'POST',
            url: form.attr('action'),
            dataType: 'json',
            data: data,
            beforeSend: function() {
                __disable_submit_button($("input[type='submit']"));
            },
            success: function(result) {
                if (result.success === true) {
                    toastr.success(result.msg);
                    let supplierName = result.supplier.supplier_name;
                    let supplierId = result.supplier.id;
                    $('#supplier_id').append('<option value="' + supplierId + '" selected="selected">' + supplierName + '</option>');

                    $('#supplier_add_modal').modal('hide');
                    $('#modal_supplier_name').val('');
                    $('#modal_supplier_cnic').val('');
                    $('#modal_supplier_mobile').val('');
                    $('#modal_supplier_phone').val('');
                    $('#modal_supplier_address').val('');
                    __enable_submit_button($("input[type='submit']"));
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $(document).on('submit', 'form#product_ajax_form', function(e) {
        e.preventDefault();
        var form = $(this);
        var data = form.serialize();

        $.ajax({
            method: 'POST',
            url: form.attr('action'),
            dataType: 'json',
            data: data,
            beforeSend: function() {
                __disable_submit_button($("input[type='submit']"));
            },
            success: function(result) {
                if (result.success === true) {
                    toastr.success(result.msg);

                    $('#product_add_modal').modal('hide');
                    $('#modal_product_name').val('');
                    $('#modal_category_id').val('');
                    $('#modal_unit').val('');
                    $('#modal_price').val('');
                    __enable_submit_button($("input[type='submit']"));
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $(document).on('submit', 'form#customer_ajax_form', function(e) {
        e.preventDefault();
        var form = $(this);
        var data = form.serialize();

        $.ajax({
            method: 'POST',
            url: form.attr('action'),
            dataType: 'json',
            data: data,
            beforeSend: function() {
                __disable_submit_button($("input[type='submit']"));
            },
            success: function(result) {
                if (result.success === true) {
                    toastr.success(result.msg);

                    let customerName = result.customer.customer_name;
                    let customerId = result.customer.id;
                    $('#customer_id').append('<option value="' + customerId + '" selected="selected">' + customerName + '</option>');

                    $('#customer_add_modal').modal('hide');
                    $('#modal_customer_name').val('');
                    $('#modal_customer_cnic').val('');
                    $('#modal_customer_mobile').val('');
                    $('#modal_customer_phone').val('');
                    $('#modal_customer_address').val('');
                    __enable_submit_button($("input[type='submit']"));
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $('#product_add_modal').on('show.bs.modal', function (e) {
       $('#modal_category_id').select2({
           dropdownParent: $('#product_add_modal')
       });
        $('#modal_unit').select2({
            dropdownParent: $('#product_add_modal')
        });
    });

    function __disable_submit_button(element) {
        element.attr('disabled', true);
    }

    function __enable_submit_button(element) {
        element.attr('disabled', false);
    }
</script>
