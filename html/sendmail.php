<?php
  $to = "frankrodelli93@gmail.com";
  $subject = "Test mail";
  $message = "My message";
  $from = "support@showmeyouraxels.me";
  $headers = "From:" . $from;
  mail($to,$subject,$message,$headers);
?>