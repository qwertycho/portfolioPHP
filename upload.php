<?php

$data = json_decode(file_get_contents('php://input'), true);
print_r($data);

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
} else {
  echo "Connection succesfull";
  if($data["action"] == "project"){
    $sql = "INSERT INTO projecten (projectTitel, projectOmschrijving, projectDatum, projectEindDatum, projectUrl, projectRepo) VALUES ('".$data["titel"]."', '".$data['projectOmschrijving']."', '".$data['projectDatum']."', '".$data['projectEindDatum']."', '".$data['projectUrl']."', '".$data['projectRepo']."')";
    echo $sql;
  } else if($data["action"] == "techniek"){
    $sql = "INSERT INTO technieken (techniekNaam, techniekClass) VALUES ('".$data["techniekNaam"]."','".$data["techniekClass"]."')";	
    echo $sql;
  } else {
    echo "No action";
  }

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

}
$conn->close();