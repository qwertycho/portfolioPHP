<?php

$data = $_POST;

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

    $file = $_FILES["fileToUpload"];
    $imgName = $file["name"];

    var_dump($file);

    // save the img to the server
    $target_dir = "./img/";
    $target_file = $file["tmp_name"];
    $newName = time().".".getExtension($file["type"]);	

    echo rename($file["tmp_name"], $target_dir.$newName);

    $query = "INSERT INTO afbeeldingen (link) VALUES ('".$imgName."')";
    echo mysqli_query($conn, $query);
    $id = mysqli_insert_id($conn);



  } else {
    echo "No action";
  }


}
$conn->close();

function getExtension($type){
  switch($type){
    case "image/jpeg":
      return "jpg";
    case "image/png":
      return "png";
    case "image/gif":
      return "gif";
    default:
      return "jpg";
  }
}