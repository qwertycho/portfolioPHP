<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("secret.php");

global $conn ;
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * from projecten";
$result = $conn->query($sql);
print_r($result);

function getProjecten(){
    global $conn;
    $sql = "SELECT * from projecten";
    $result = $conn->query($sql);
    print_r($result);
 
}
