<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("modules/secret.php");
require_once("Router.php");

$Router = new Router();

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

global $projecten;

$projectenSQL = "SELECT * from projecten";
$projecten = $conn->query($projectenSQL);
$projecten = $projecten->fetch_all(MYSQLI_ASSOC);

global $technieken;

$techniekenSQL = "SELECT techniek AS id from technieken";
$technieken = $conn->query($techniekenSQL);
$technieken = $technieken->fetch_all(MYSQLI_ASSOC);

$Router->render('/projecten', 'projecten');