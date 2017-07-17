<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css">
<link rel="stylesheet" type="text/css" media="all" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.print.css">

<div id='calendar'></div>

<script>
$(document).ready(function() {

  var myCalendar = $('#calendar');
  myCalendar.fullCalendar();

  $.ajax({
          url : 'https://showmeyouraxels.me/browse.php',
          type : 'post',
          dataType: 'json',
          success: function(e){
            console.log('is it here');
            console.log(e);
              if(e.success){
                console.log('here');
                  var events = [];
                  $.each(e.events,function(index,value){
                      events.push({
                          title : value.title,
                          start : moment(value.start).toDate('2017/07/18 12h:00'),
                          end : moment(value.end).toDate('2017/07/18 12h:30'),
                      });
                  });
                  console.log(events);
                  console.log('anything');
                  alert('sofwe1');
                  calendar.fullCalendar( 'addEventSource', events);
              }
          }
      });
});

</script>
