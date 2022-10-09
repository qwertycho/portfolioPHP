<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$data = $_GET["action"];

$servername = "85.184.251.4";
$username = "portfolio";
$password = "VierenVeertig26";
$dbname = "portfolio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  echo "Connection failed";
} else{
  if($data == "project"){
    $sql = "SELECT * FROM projecten";
  } else if($data == "techniek"){
    $sql = "SELECT techniekNaam, techniekClass FROM technieken WHERE projectID = 0";
  } else {
    echo "No action";
  }

  $result = $conn->query($sql);
  echo json_encode($result->fetch_all(MYSQLI_ASSOC));

}
$conn->close();