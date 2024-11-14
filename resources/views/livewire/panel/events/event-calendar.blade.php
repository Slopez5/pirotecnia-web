<div>
    <div id="calendar"></div>
</div>

@script
    <script>
         calendarEl = document.getElementById('calendar');
         calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                    left: '',
                    center: 'title',
                    right: ''
                },
            initialView: 'dayGridMonth',
            height: 'auto',
            events: $wire.events,
            dateClick: function(info) {
                $wire.dispatch('selectDate', {date: info.dateStr});
            }
        });
        calendar.render();
    </script>
@endscript
