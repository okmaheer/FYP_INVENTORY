<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/fullcalendar/css/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/vendor.min.css') }}">
    <style>
        .bordered {
            border-left: 5px solid !important;
        }
    </style>
</head>
<body>

            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Event Calender</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="event-calendar"></div>
                <div style='clear:both'></div>
            </div>

</body>
<script src="{{ asset('dashboard/vendor.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/moment/moment.js') }}"></script>
<script src="{{ asset('dashboard/plugins/fullcalendar/js/fullcalendar.min.js') }}"></script>
@include('dashboard.marquee.bookings.components.calendar-init')
</html>
