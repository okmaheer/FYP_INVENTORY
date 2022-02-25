<script>
    (function () {
        $('select').select2();
    })();

    function getMenuFoodItems(cElement) {
        let id = $(cElement).find('option:selected').val();
        $.ajax({
            type: 'GET',
            url: "/api/marquee/food_items_by_menu_id/" + id,
            success: function (response) {
                if (response.status === true) {
                    $("#food_items_body").empty().append(response.data);
                    applyCalculations();
                } else {
                    alert("No Menu Found with this Id")
                }
            }
        });
    }

    function cloneRow(cElement) {
        let clone = $(cElement).closest('tr').clone();
        $(clone).find('input[type=text]').val('');
        $(clone).find('input[type=number]').val('');
        $(clone).find('input[type=hidden]').val('');
        $(cElement).closest('tbody').append(clone);

    }

    function removeClonedRow(cElement) {
        let length = $(cElement).closest('tbody').find('tr').length;
        if (length > 2) {
            $(cElement).closest('tr').remove();
        } else {
            alert("At least one row is Required")
        }

    }


    function applySearchingOnMenu(cElement) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        var options = {
            source: function (request, response) {
                $.ajax({
                    type: 'GET',
                    url: "/autocomplete/demand?d=" + $(cElement).val(),
                    success: function (data) {
                        response(data);
                    }
                });
            },
            focus: function (event, ui) {
                $(this).val(ui.item.label);
                return false;
            },
            select: function (event, ui) {
                $(this).val(ui.item.label);
                $(cElement).closest('tr').find('.current_id').val(ui.item.value);
                $(cElement).closest('tr').find('.current_price').val(ui.item.extra.price);

                $(this).unbind("change");
                return false;
            }
        };
        $('body').on('keypress.autocomplete', '.current_product', function () {
            $(this).autocomplete(options);
        });
    }
    function searchBooking(){
        var booking_no = $('#booking_no').val();
        if ( booking_no == 0) {
            alert('Please select Booking No !');
            return false;
        }
        // console.log('booking number is :'+ booking_no);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'GET',
            url: "/autocomplete/booking?d=" + booking_no,
            success: function (data) {
                if($.trim(data)){
                    document.getElementById('event_date').value = data['data'].event_date;

                    if (data['data'].event_time == '2') {
                        document.getElementById('event_time').value = 'Dinner';
                    } else {
                        document.getElementById('event_time').value = 'Lunch';
                    }

                    document.getElementById('no_person').value = data['data'].no_person;
                    console.log(data);
                }

            }
        });

    }


</script>
