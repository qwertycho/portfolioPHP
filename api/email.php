<?php

require_once("modules/secret.php");

global $keys;

$to = $keys->email;
$from = $_POST['emailAdres'];

$subject = "Contactformulier";

$message = $_POST['bericht'];

$headers = "From: $from";

mail($to, $subject, $message, $headers);

header("Location: /contact");