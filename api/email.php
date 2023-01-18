<?php

// var_dump($_POST);

$to = "tycho@tychovanopstal.com";
$from = $_POST['emailAdres'];

$subject = "Contactformulier";

$message = $_POST['bericht'];

$headers = "From: $from";

mail($to, $subject, $message, $headers);

header("Location: /contact");