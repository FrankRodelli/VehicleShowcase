<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css">
<link rel="stylesheet" type="text/css" media="all" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.print.css">

<div id='calendar'></div>

<script>
$(document).ready(function() {
  var event = [];
  var eventsArray = [];
  event[0] = "title";
  event[1] = new Date(2017,07,18);
  eventsArray.push(event);

  var formattedEventData = [];
  for (var k = 0; k < eventsArray.length; k++) {
      formattedEventData.push({
          title: eventsArray[k][0],
          start: eventsArray[k][1]
      });
  }
  console.log(formattedEventData);

  $('#calendar').fullCalendar({
      //eventsource: formattedEventData,
      events: formattedEventData,
      color: 'yellow',
      textColor: 'black'
  });

  $('#calendar').fullCalendar('addEventSource', formattedEventData);
  $('#calendar').fullCalendar('rerenderEvents', formattedEventData[, stick]);
});

</script>
