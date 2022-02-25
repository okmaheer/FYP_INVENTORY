@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
@endsection
@section('innerScript')
    <script>
        let editMode = false;
        let recordNo = 0;

        @if(isset($for))
            editMode = true;
            recordNo = "{{ $model->id }}";
        @endif

        $(document).ready(function() {
            $('.select2').select2();
        });

        $("#event_time").change(function () {
            let eventTime = this.value;
            if (eventTime == 1) {
                $('#start_time').val('12:00');
                $('#end_time').val('16:00');
            } else {
                $('#start_time').val('18:00');
                $('#end_time').val('22:00');
            }
            checkBooking();
        });
        $("#event_date").change(function () {
            checkBooking();
        });

        function checkBooking() {
            let date = $('#event_date').val();
            let time = $('#event_time').val();

            if (date.length && time.length) {
                $.ajax({
                    type: 'POST',
                    data: {'date': date, 'time': time, 'tentative': recordNo},
                    url: "{{ route('booking.available') }}",
                    success: function (result) {
                        if (result.success === false) {
                            $('#btn_save').attr('disabled', true);
                            if ($('#btn_update').length) {
                                $('#btn_update').attr('disabled', true);
                            }
                            if ($('#btn_save_print').length) {
                                $('#btn_save_print').attr('disabled', true);
                            }
                            if ($('#btn_update_print').length) {
                                $('#btn_update_print').attr('disabled', true);
                            }

                            swal.fire({
                                title: result.msg,
                                type: "warning",
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
                            });
                        } else {
                            $('#btn_save').attr('disabled', false);
                            if ($('#btn_update').length) {
                                $('#btn_update').attr('disabled', false);
                            }
                            if ($('#btn_save_print').length) {
                                $('#btn_save_print').attr('disabled', false);
                            }
                            if ($('#btn_update_print').length) {
                                $('#btn_update_print').attr('disabled', false);
                            }
                        }
                    }
                });
            }
        }
    </script>
@endsection
