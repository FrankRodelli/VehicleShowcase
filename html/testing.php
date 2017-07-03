<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Croppie</title>
<meta name="keywords" content="CSS3" />
<meta name="description" content="HTML5、CSS3、jquery、PHP" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.4.1/croppie.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.4.1/croppie.css">
</head>
<style type="text/css">
  .demo{width:360px; margin:60px auto 10px auto}

button,
a.btn {
    background-color: #189094;
    color: white;
    padding: 10px 15px;
    border-radius: 3px;
    border: 1px solid rgba(255, 255, 255, 0.5);
    font-size: 16px;
    cursor: pointer;
    text-decoration: none;
    text-shadow: none;
}
button:focus {
    outline: 0;
}

.file-btn {
    position: relative;
}
.file-btn input[type="file"] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
}

.actions {
    padding: 5px 0;
}
.actions button {
    margin-right: 5px;
}
.crop{display:none}
#result img{
  border: solid 5px #C0C0C0;
} 
</style>
<body>


<div id="main">


  <div class="demo">
    <div class="actions">
            <button class="file-btn">
                <span>Cargar</span>
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
<script>
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
        height: 300,
        type: 'squere'
      },
      boundary: {
        width: 400,
        height: 550
      }
    });

    $('#upload').on('change', function () { 
      $(".crop").show();
      readFile(this); 
    });
    $('.upload-result').on('click', function (ev) {
      $uploadCrop.croppie('result', 'canvas').then(function (resp) {
        popupResult({
          src: resp
        });
        $.ajax({
          url: 'upload.php',
          type: 'POST',

          data: {imagebase64: resp},
          success:function(data)
          {
            console.log(data);
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
      html = '<img src="' + result.src + '" />';
    }
    $("#result").html(html);
  }
});
</script>


</body>
</html>