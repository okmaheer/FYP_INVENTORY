<script>
     function getSubHeads() {
            var MainHead = $('#income_head').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'GET',
                url: "{{ route('autocomplete.subincomehead') }}" + "?d=" + MainHead,
                success: function (data) {

                    $('#income_head_child').empty();
                    $("#income_head_child").append('<option>Select Sub Income Head</option>');
                    if (data) {
                        $.each(data,function(key,value){
                            $('#income_head_child').append($("<option/>", {
                                value: key,
                                text: value
                            }));
                        });
                    }

                }
            });

        }
</script>