<?php include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link rel="shortcut icon" href="favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Archivo+Narrow:400,700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/home.css" rel="stylesheet" type="text/css" media="all" />

</head>

<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="menu">
		<img src="images/logo.png" alt="Mycarlogo" height="40" width="40">
		<h1>FBMotors</h1>
			<ul class="nav">
				<li class="active"><a href="index.php" accesskey="1" title="">Home</a></li>
				<li><a href="mycars.php" accesskey="2" title="">My Cars</a></li>
				<li><a href="add.php" accesskey="3" title="">Add Car</a></li>
				<li><a href="logout.php" accesskey="4" title="">Logout</a></li>
			</ul>
			<div id="search">
			<input type="submit" name="Search" value="Search">
			<input type="text" name="Search" placeholder="Serach">
			</div>
		</div>
	</div>
</div>

<div id="page-wrapper">
<div id="stream-container">

<div id="left-column">
	<div id="top-center">
	<h2>Featured Vehicles</h2>
	<img src="https://pbs.twimg.com/media/C6J6rz1WUAAjfXd.jpg:small" width="75%">
	</div>

	<div id="bottom-center">
	<h2>Recently Added</h2>
	<img src="https://pbs.twimg.com/media/C6J6rz1WUAAjfXd.jpg:small" width="75%">
	</div>

</div>

<div id="right-column">
<h2>Upcoming Events</h2>
<img src="https://cdn.vertex42.com/calendars/2017/printable-2017-calendar-monthly-black.png" width="90%">
</div>

<div id="center-column">
<h2>Vehicle Feed</h2>

</div>

<div id="leftlower-column">
<h2>New Div</h2>=
</div>

</div>
</div>

<div id="copyright">
<p>&copy; 2017 FBMotors Inc. All Rights Reserved.</p>
</div>

</body>
</html>
