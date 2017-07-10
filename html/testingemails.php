<?php
// using SendGrid's PHP Library
// https://github.com/sendgrid/sendgrid-php
// If you are using Composer (recommended)
require("sendgrid-php/sendgrid-php.php");
$from = new SendGrid\Email("Example User", "webmaster@showmeyouraxels.me");
$subject = "Sending with SendGrid is Fun";
$to = new SendGrid\Email("Example User", "glenn.helping@gmail.com");
$content = new SendGrid\Content("text/plain", "and easy to do anywhere, even with PHP");
$mail = new SendGrid\Mail($from, $subject, $to, $content);
$apiKey = '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';
$sg = new \SendGrid($apiKey);
$response = $sg->client->mail()->send()->post($mail);
echo $response->statusCode();
print_r($response->headers());
echo $response->body();
?>