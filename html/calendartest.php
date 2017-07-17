<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css">
<link rel="stylesheet" type="text/css" media="all" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.print.css">

<div id='calendar'></div>

<script>
$(document).ready(function() {

  var calendar = $('#calendar').fullCalendar({
        customButtons: {
            myCustomButton: {
                text: 'Add Event',
                click: function() {

                }
            }
        },
         header: {
            left: 'prev,next today myCustomButton',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        editable : false,
        eventLimit: true,
        eventClick: function(calEvent, jsEvent, view, element) {
        },
        eventRender: function(event, element) {
            element.attr("data-id",event.id);
        },

    });

  $.ajax({
          url : 'https://showmeyouraxels.me/browse.php',
          type : 'post',
          dataType: 'json',
          success: function(e){
            console.log(e);
            var events = [];
            $.each(e.events,function(index,value){
              console.log(value.title + 'this');
                events.push({
                    title : value.title,
                    start : moment(value.start).toDate('2017/07/18 12h:00'),
                    end : moment(value.end).toDate('2017/07/18 12h:30'),
                });
            });
            console.log(events);
            calendar.fullCalendar( 'addEventSource', events);
          }
      });
});

</script>
