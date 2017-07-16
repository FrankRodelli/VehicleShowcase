<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css">
<link rel="stylesheet" type="text/css" media="all" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.print.css">

<div id='calendar'></div>

<script>
$(document).ready(function() {
  var event = new Object;
  event.title = "Really awesome new event here";
  event.start = new Date("July 18, 2017 11:13:00");
  event.end = new Date("July 18, 2017 12:13:00");
  event.start = moment(event.start).toDate('2017/07/18 12h:00');
  event.end = moment(event.end).toDate('2017/07/18 12h:30');

  var myCalendar = $('#calendar');
  myCalendar.fullCalendar();
  myCalendar.fullCalendar('renderEvent', event);
});

</script>
