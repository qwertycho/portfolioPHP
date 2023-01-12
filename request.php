<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$data = $_GET["action"];

require("./modules/secret.php");
require("modules/fetch.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  echo "Connection failed";
} else{
  if($data == "project"){
    $sql = "SELECT * FROM projecten";
  } else if($data == "technieken"){

    print_r(getTechnieken());

  } else {
    echo "No action";
  }


}
$conn->close();