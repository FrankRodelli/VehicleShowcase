<?php include("php/auth.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Settings</title>
<link rel="shortcut icon" href="favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Archivo+Narrow:400,700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">
<link href="../css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/settings.css" rel="stylesheet" type="text/css" media="all" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.4.1/croppie.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.4.1/croppie.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>

<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="menu">
		<img class="logo" src="../images/logo.png" alt="Mycarlogo" height="40" width="40">
		<h1>FBMotors</h1>
			<ul class="nav">
				<li><a href="../index.php" accesskey="1" title="">Home</a></li>
				<li><a href="../browse.php" accesskey="2" title="">Browse</a></li>
				<li><a href="../events.php" accesskey="3" title="">Events</a></li>
				<li><a href="../about.php" accesskey="4" title="">About</a></li>
        <li><img id="search-button" class="search" src="https://cdn0.iconfinder.com/data/icons/octicons/1024/search-128.png" height="20px"> </li>
			</ul>


			<div id="search-bar" style="display: none;">
			Search here
			</div>

<?php include("php/header.php"); ?>

<div id="page-wrapper">
<div id="container">

<div id="select-category">
<a href="#" onclick="showSetting('profile');">Edit Profile</a><br>
<a href="#" onclick="showSetting('following');">Edit Following</a><br>
<a href="#" onclick="showSetting('vehicles');">Edit Vehicles</a><br>
</div>


<div id="edit-profile" style="display: block;">
<div id="main">
  <div class="demo">
    <div class="actions">
            <button class="file-btn">
                <span>Browse</span>
                <input type="file" id="upload" value="image" />
            </button>
            <div class="crop">
        <div id="upload-demo"></div>
        <button class="upload-result">Upload</button>
      </div>
      <div id="result"></div>
        </div>
  </div>
</div>

<div class="form-style-2">
<div class="form-style-2-heading">Edit Profile</div>
<form method = "POST" enctype = "multipart/form-data">

<!--Populates values from previous entry-->
<?php include("php/settings/populate-user-settings.php"); ?>
<!--Posts values to database-->
<?php include("php/settings/post-user-settings.php"); ?>

</form>
</div>
</div>

<div id="edit-following" style="display: none;">
<div id="following">

</div>
</div>

<div id="edit-vehicles" style="display: none;">
<?php include('php/settings/post-vehicle-settings.php'); ?>
<div id="vehicles">

</div>
</div>
</div>
</div>
</div>
</div>

<div id="copyright">
<p>&copy; 2017 FBMotors Inc. All Rights Reserved.</p>
</div>

</body>
</html>

<!--Manages profile picture -->
<script type="text/javascript">
$(function(){
  var $uploadCrop;
    function readFile(input) {
      if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                $uploadCrop.croppie('bind', {
                  url: e.target.result
                });
                $('.upload-demo').addClass('ready');
                  // $('#blah').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
          }
          else {
            alert("Sorry - you're browser doesn't support the FileReader API");
        }
    }

    $uploadCrop = $('#upload-demo').croppie({
      viewport: {
        width: 200,
        height: 200,
        type: 'square'
      },
      boundary: {
        width: 300,
        height: 250
      }
    });

    $('#upload').on('change', function () { 
      $(".crop").show();
      readFile(this); 
    });

  function popupResult(result) {
    var html;
    if (result.html) {
      html = result.html;
    }
    if (result.src) {
      html = '<img src="' + result.src + '" width="200px"/>';
    }
    $("#result").html(html);
  }
});
</script>

<!--Manages default photo for vehicle -->
<script type="text/javascript">
var carId;

//Sets selected vehicle hash and highlights image
function photoSelected(vehicleHash,elem){
  carId = vehicleHash;
  var div = document.getElementsByClassName('photo-container')
  var selected = document.getElementById(elem)
  for (i=0; i < div.length; i++){
    div[i].classList.remove('selected')
  }
  selected.classList.add('selected')
}

var basic;
function setDefault() {
  if(carId != undefined){
      var $w = $('.basic-width'),
        $h = $('.basic-height'),
        basic = $('#demo-basic').croppie({
        viewport: {
          width: 500,
          height: 281
        },
        boundary: {
          width: 500,
          height: 281
        }
      });
      basic.croppie('bind', {
        url: '../uploads/vehicles/'+carId,
        points: [77,469,280,739]
      }).then(function(){
        basic.croppie('setZoom', 0)
      });

      $('.basic-result').on('click', function() {
        var w = parseInt($w.val(), 10),
          h = parseInt($h.val(), 10),s
          size = 'viewport';
        if (w || h) {
          size = { width: w, height: h };
        }
        basic.croppie('result', {
          type: 'canvas',
          size: size
        }).then(function (resp) {
          popupResult({
            src: resp
          });
            $.ajax({
            url: 'php/settings/upload-default-vepic.php',
            type: 'POST',

            data: {imagebase64: resp,vehicleID: vehicleID},
            success:function(data)
            {
              basic.croppie('destroy');
            }
          });
        });
      });

      function popupResult(result) {
      var html;
      if (result.html) {
        html = result.html;
      }
      if (result.src) {
        html = 'Default Photo Saved!<br><img src="' + result.src + '" />';
      }
      swal({
        title: '',
        html: true,
        text: html,
        allowOutsideClick: true
      });
      setTimeout(function(){
        $('.sweet-alert').css('margin', function() {
          var top = -1 * ($(this).height() / 2),
            left = -1 * ($(this).width() / 2);

          return top + 'px 0 0 ' + left + 'px';
        });
      }, 1);
    }
  }else{
    alert('Select photo to set as default');
  }
}
carId = undefined;

function uploadVePic(){
  var formData = document.getElementById('files');
  $.ajax({
    url: 'php/settings/upload-vepic.php',
    type: 'POST',

    data: formData,
    processData: false,
    contentType: false,
    success:function(data)
    {
      alert(data);
    }
  });

}

</script>



<!--Popout menu script -->
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

<!--Search Bar Script -->
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
  var profile = document.getElementById('edit-profile');
  var following = document.getElementById('edit-following');
  var vehicles = document.getElementById('edit-vehicles');

  function showSetting(target){
    if(target == "profile"){
      profile.style.display = 'block';
      following.style.display = 'none';
      vehicles.style.display = 'none';
    }
    else if(target == "following"){
      profile.style.display = 'none';
      following.style.display = 'block';
      vehicles.style.display = 'none';
      $.ajax({
        url: 'php/settings/populate-following.php',
        type: 'POST',
        success:function(data)
        {
          $('#following').html(data);
        }
      });
    }
    else if(target == "vehicles"){
      profile.style.display = 'none';
      following.style.display = 'none';
      vehicles.style.display = 'block';
      $.ajax({
        url: 'php/settings/populate-vehicles.php',
        type: 'POST',
        success:function(data)
        {
          $('#vehicles').html(data);
        }
      });
    }
  }
</script>

<script type="text/javascript">
var vehicleID;
function carStuff(carHash){
  vehicleID = carHash;
  var url="../php/settings/populate-vehicle-settings.php"
  var phprequest = new XMLHttpRequest();
  phprequest.open("POST", url, true);
  phprequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  phprequest.onreadystatechange = function(){
    if(phprequest.readyState == 4 && phprequest.status == 200){
      var return_data = phprequest.responseText;
      document.getElementById("vehicles").innerHTML = return_data;
    }
  }
  phprequest.send("hash="+carHash);

  window.setTimeout(loadFileSelect, 1000);


}

function loadFileSelect(){
  function handleFileSelect(evt) {
    var files = evt.target.files;

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = 
          [
            '<img style="height: 75px; border: 1px solid #000; margin: 5px" src="', 
            e.target.result,
            '" title="', escape(theFile.name), 
            '"/>'
          ].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
    document.getElementById('upload-container').innerHTML = '<br><button onclick="uploadVePic()">Upload</button>';
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);
}
</script>
