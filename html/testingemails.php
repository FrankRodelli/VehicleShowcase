<?php
// using SendGrid's PHP Library
// https://github.com/sendgrid/sendgrid-php
// If you are using Composer (recommended)
require("sendgrid-php/sendgrid-php.php");
$from = new SendGrid\Email("Showmeyouraxels Support", "support@showmeyouraxels.me");
$subject = "Email Verification";
$to = new SendGrid\Email("Jake L", "glenn.helping@");
$content = new SendGrid\Content("text/plain", "Hi, here is the link. ");
$mail = new SendGrid\Mail($from, $subject, $to, $content);
$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);
$response = $sg->client->mail()->send()->post($mail);
echo $response->statusCode();
print_r($response->headers());
echo $response->body();
?>