<script>
    $(document).ready(function() {
        var calendar = $('#event-calendar').fullCalendar({
            header: {
                left: 'title',
                center: 'month,agendaWeek,agendaDay,listWeek',
                right: 'prev,next today'
            },
            editable: false,
            firstDay: 1,
            selectable: false,
            defaultView: 'month',
            axisFormat: 'h:mm',
            allDaySlot: false,
            selectHelper: false,
            droppable: false,
            views: {
                day: {
                    titleFormat: "DD MMMM YYYY",
                },
                week:{
                    titleFormat: "DD MMMM YYYY",
                    columnHeaderFormat: "ddd DD/MMM",
                },
                month: {
                    titleFormat: "MMMM YYYY",
                    columnHeaderFormat: "dddd",
                }
            },
            events: [
                @foreach ($bookings as $booking)
                    @php $event_start_date = \Carbon\Carbon::parse($booking->event_date)->format('Y-m-d') . 'T' . $booking->start_time; @endphp
                    @php $event_end_date = \Carbon\Carbon::parse($booking->event_date)->format('Y-m-d') . 'T' . $booking->end_time; @endphp
                    @if($booking->event_area == 1)
                        @foreach ($booking->venue as $ven)
                            {
                                title: "{{ \MarqueeHelper::eventType($booking->event_type) }}, {{ $booking->customer->customer_name }}",
                                start: "{{ $event_start_date }}",
                                end: "{{ $event_end_date }}",
                                allDay: false,
                                color: "{{ $booking->eventAreaColor($ven) }}",
                                textColor: '#000000',
                                description: "<b>{{ \MarqueeHelper::eventTime($booking->event_time) }}</b><br />" +
                                                "Time: {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}<br />" +
                                                "Event Area: {{ $booking->eventAreaName($ven) }}",
                                url: "{{ route('marquee.booking.sheet.function', $booking->id) }}",
                            },
                        @endforeach
                    @else
                        {
                            title: "{{ \MarqueeHelper::eventType($booking->event_type) }}, {{ $booking->customer->customer_name }}",
                            start: "{{ $event_start_date }}",
                            end: "{{ $event_end_date }}",
                            allDay: false,
                            className: "bg-soft-primary",
                            description: "<b>{{ \MarqueeHelper::eventTime($booking->event_time) }}</b><br />" +
                                "Time: {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}<br />" +
                                "Event Area: Outdoor",
                            url: "{{ route('marquee.booking.sheet.function', $booking->id) }}",
                        },
                    @endif
                @endforeach

                //Tentative Bookings
                @foreach ($tentativeBookings as $booking)
                    @php $event_start_date = \Carbon\Carbon::parse($booking->event_date)->format('Y-m-d') . 'T' . $booking->start_time; @endphp
                    @php $event_end_date = \Carbon\Carbon::parse($booking->event_date)->format('Y-m-d') . 'T' . $booking->end_time; @endphp
                    @if($booking->event_area == 1)
                        @foreach ($booking->venue as $ven)
                            {
                                title: "{{ \MarqueeHelper::eventType($booking->event_type) }}, {{ $booking->customer_name }}",
                                start: "{{ $event_start_date }}",
                                end: "{{ $event_end_date }}",
                                allDay: false,
                                color: "{{ $booking->eventAreaColor($ven) }}",
                                textColor: '#000000',
                                className: 'bordered',
                                description: "<b>{{ \MarqueeHelper::eventTime($booking->event_time) }}</b><br />" +
                                    "Time: {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}<br />" +
                                    "Event Area: {{ $booking->eventAreaName($ven) }}",
                                {{--url: "{{ route('marquee.booking.sheet.function', $booking->id) }}",--}}
                            },
                        @endforeach
                    @else
                        {
                            title: "{{ \MarqueeHelper::eventType($booking->event_type) }}, {{ $booking->customer_name }}",
                            start: "{{ $event_start_date }}",
                            end: "{{ $event_end_date }}",
                            allDay: false,
                            className: "bg-soft-primary bordered",
                            description: "<b>{{ \MarqueeHelper::eventTime($booking->event_time) }}</b><br />" +
                                "Time: {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}<br />" +
                                "Event Area: Outdoor",
                            {{--url: "{{ route('marquee.booking.sheet.function', $booking->id) }}",--}}
                        },
                    @endif
                @endforeach
            ],
            eventRender: function(eventObj, $el) {
                $el.popover({
                    title: eventObj.title,
                    content: eventObj.description,
                    trigger: 'hover',
                    placement: 'top',
                    container: 'body',
                    html: true,
                });
            },
            eventClick: function(event) {
                if (event.url) {
                    window.open(event.url);
                    return false;
                }
            }
        });
    });
</script>
