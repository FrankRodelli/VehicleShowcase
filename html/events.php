<?php include("php/auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Events</title>
<link rel="shortcut icon" href="favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Archivo+Narrow:400,700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/events.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/clappr/latest/clappr.min.js"></script>
<script type="text/javascript" src="js/instascan.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css">
<link rel="stylesheet" type="text/css" media="print" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.print.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

</head>

<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="menu">
		<img class="logo" src="images/logo.png" alt="Mycarlogo" height="40" width="40">
		<h1>FBMotors</h1>
			<ul class="nav">
				<li><a href="index.php" accesskey="1" title="">Home</a></li>
				<li><a href="browse.php" accesskey="2" title="">Discover</a></li>
				<li class="qrli">
					<div class="mask pseudo">
						<a href="#" onclick="openQRScanner()"><img class="qr" src="https://www.qrstuff.com/images/sample.png" height="40px"></a>
					</div>
				</li>
				<li><a href="events.php" accesskey="3" title="">Events</a></li>
				<li><a href="about.php" accesskey="4" title="">About</a></li>
				<li><img id="search-button" class="search" src="https://cdn0.iconfinder.com/data/icons/octicons/1024/search-128.png" height="20px"> </li>
			</ul>

			<div id="search-bar" style="display: none;">
			Search here
			</div>

<?php include("php/header.php"); ?>
		</div>
	</div>
</div>

<div id="page-wrapper">
  <div id="page-container">

  	<div id="qr-container" style="display:none;">
  		<h2>Scan QR Code</h2>
  		<video id="qr-preview"></video>
  	</div>

    <div id="options">
      <ul class="options">
        <li><a href="#add" onclick="showSetting('add')">Add Event</a></li>
        <li><a href="#edit" onclick="showSetting('edit')">Edit Your Events</a></li>
        <li><a href="#manage" onclick="showSetting('manage')">Manage Events You're Going To</a></li>
    </div>

    <div id='calendar'></div>

  <div id="options-wrapper" style="display: none;">
      <div id="add-event">
        <div class="form-style-2">
        <form id="add-event-form" method ="POST" enctype = "multipart/form-data">

        <label for="title"><span>Title <span class="required">*</span></span>
          <input type="text" class="input-field" name="title" value="" /></label>

        <label for="start"><span>Start Time <span class="required">*</span></span>
          <input type="datetime-local" class="input-field" name="start" value="" /></label>

        <label for="end"><span>End Time <span class="required">*</span></span>
          <input type="datetime-local" class="input-field" name="end" value="" /></label>

        <label for="location"><span>Location </span>
          <input type="text" class="input-field" name="location" value="" /></label>

        <label for="desc"><span>Description </span>
          <textarea name="desc" class="textarea-field" cols="750"></textarea></label>

          <label for="specialin"><span>Special Instructions </span>
            <textarea name="specialin" class="textarea-field" cols="750"></textarea></label>

        <label><span>&nbsp;</span>
          <input name="addevent" type="button" value="Add Event" onclick="addEvent()" /></label>
        </div>
      </div>

      <div id="edit-event">
      </div>

      <div id="manage-events">
      </div>


    </div>
  </div>
</div>

<div id="copyright">
<p>&copy; 2017 FBMotors Inc. All Rights Reserved.</p>
</div>

</body>
</html>

<script type="text/javascript">

function addEvent() {
  var formData = new FormData($("#add-event-form")[0]);

  $.ajax({
      url: 'php/events/add-event.php',
      type: 'POST',
      data: formData,
      mimeType: "multipart/form-data",
      contentType: false,
      cache: false,
      processData: false,
      success: function(data) {
        console.log(data);
      }
  });
}

</script>

<script type="text/javascript">

var add_event = document.getElementById('add-event');
var edit_event = document.getElementById('edit-event');
var manage_events = document.getElementById('manage-events');
var currentSettingPage = window.location.href.split('#')[1];

//Calls show setting passing the current page string on load
showSetting(currentSettingPage);

//Displays setting category based on value and uses xhr
//request to load data
function showSetting(target) {
    if (target == "add" || target == undefined) {
        add_event.style.display = 'block';
        edit_event.style.display = 'none';
        manage_events.style.display = 'none';
    } else if (target == "edit") {
        add_event.style.display = 'none';
        edit_event.style.display = 'block';
        manage_events.style.display = 'none';
    } else if (target == "manage") {
        add_event.style.display = 'none';
        edit_event.style.display = 'none';
        manage_events.style.display = 'block';
    }
}

</script>


<script type="text/javascript">
var div1 = document.getElementById('propic');
var data1 = document.getElementById('popout-menu');
div1.addEventListener("click", function() {
    		if(data1.style.display !== 'none'){
			data1.style.display = 'none';
		}
		else{
			data1.style.display = 'block';
		}
}, false);
</script>
<script type="text/javascript">
var div2 = document.getElementById('search-button');
var data2 = document.getElementById('search-bar');
div2.addEventListener("click", function() {
    		if(data2.style.display !== 'none'){
			data2.style.display = 'none';
		}
		else{
			data2.style.display = 'block';
		}
}, false);
</script>

<script type="text/javascript">
var active = false;
var qrContainer = document.getElementById('qr-container');
function openQRScanner(){

	//Manages displaying qr-view
	if(qrContainer.style.display !== 'none'){
		qrContainer.style.display = 'none';
	}else{
		qrContainer.style.display = 'block';
	}

	if(!active){
		active = true;
		let scanner = new Instascan.Scanner({ video: document.getElementById('qr-preview') });
		scanner.addListener('scan', function (content) {
			console.log(content);
			window.location.href = content;
		});
		Instascan.Camera.getCameras().then(function (cameras) {
			if (cameras.length > 0) {
				scanner.start(cameras[0]);
			} else {a
				alert('No camera found');
				qrContainer.style.display = 'none';
			}
		}).catch(function (e) {
			console.error(e);
		});
		}
	}
</script>
<script>
$(document).ready(function() {
var events = [];
$.ajax({
				url : 'https://showmeyouraxels.me/browse.php',
				type : 'post',
				dataType: 'json',
				success: function(e){
					console.log(e[0].title);
					for(var i = 0; i < e.length; i++){
							events.push({
									title : e[i].title,
									start : moment(e[i].start).toDate('2017/07/18 12h:00'),
									end : moment(e[i].end).toDate('2017/07/18 12h:30'),
									icon: "https://www.qrstuff.com/images/sample.png",
							});
						}
					console.log(events);
					createCalendar();
				}
		});
function createCalendar(){

  var calendar = $('#calendar').fullCalendar({
        customButtons: {
            myCustomButton: {
                text: 'Add Event',
                click: function() {
                  alert('add event');
                }
            }
        },
         header: {
            left: 'prev',
            center: 'title',
            right: 'next'
        },
        editable : false,
        eventLimit: true,
				eventLimitText: '',
				dayRender: function (date, cell) {
					/*if ( !dateHasEvent(date) ){
							cell.css("background-color", "initial");
							console.log('no event ' + date.toDate());
					}
					else if ( dateHasEvent(date) ){
							cell.css("background-color", "#6b7c8c");
							console.log('event ' + date.toDate());
					}*/
				},

        eventClick: function(calEvent, jsEvent, view, element) {
					var inner = new Date(calEvent.start) + ' to ' + new Date(calEvent.end);
					swal({
							title: calEvent.title,
							html: true,
							text: inner,
							allowOutsideClick: true
					});
        },
				dayClick: function(dayEvent, jsEvent, view, element){
					console.log(dayEvent);
				},
        eventRender: function(event, element) {
					element.find('.fc-content').html('<img src="http://simpleicon.com/wp-content/uploads/flag.svg" height="10px"/><br>' +event.title);
					var eventStart = moment(event.start);
var eventEnd = event._end === null ? eventStart : moment(event.end);
var diffInDays = eventEnd.diff(eventStart, 'days');
$("td[data-date='" + eventStart.format('YYYY-MM-DD') + "']").css('background-color','#dddddd');
for(var i = 1; i < diffInDays; i++) {
		eventStart.add(1,'day');
		$("td[data-date='" + eventStart.format('YYYY-MM-DD') + "']").css('background-color','#dddddd');
}

        },
    });
		calendar.fullCalendar( 'addEventSource', events);
	}

	function dateHasEvent(date) {
		var hasEvent = false;
		for(var i = 0; i < events.length; i++){
		 var thatDate = events[i].start.toString();
		 thatDate = thatDate.split(' ');
		 thatDate = thatDate[1] +' '+thatDate[2] +' '+thatDate[3];

		 var thisDate = date.toDate().toString();
		 thisDate = thisDate.split(' ');
		 thisDate = thisDate[1] +' '+thisDate[2] +' '+thisDate[3];

		 if(thisDate == thatDate){
			 hasEvent = true;
			}
		}
		return hasEvent;
	}

});
</script>
