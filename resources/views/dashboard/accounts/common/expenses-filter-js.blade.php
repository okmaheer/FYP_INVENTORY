<script>
     function getSubHeads() {
            var MainHead = $('#expense_head').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'GET',
                url: "{{ route('autocomplete.subexpensehead') }}" + "?d=" + MainHead,
                success: function (data) {

                    $('#expense_head_child').empty();
                    $("#expense_head_child").append('<option>Select Sub Expense Head</option>');
                    if (data) {
                        $.each(data,function(key,value){
                            $('#expense_head_child').append($("<option/>", {
                                value: key,
                                text: value
                            }));
                        });
                    }

                }
            });

        }
</script>