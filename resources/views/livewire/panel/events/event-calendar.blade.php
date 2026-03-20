<div>
    <div id="calendar"></div>
</div>

@script
    <script>
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            initialView: 'dayGridMonth',
            height: 'auto',
            events: $wire.events,
            dateClick: function(info) {
                $wire.dispatch('selectDate', {
                    date: info.dateStr
                });
            }
        });

        calendar.render();
    </script>
@endscript
