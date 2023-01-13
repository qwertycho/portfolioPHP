<?php

$data = $_POST;

print_r($data);
echo "<br>";

require("./modules/secret.php");
require("./modules/auth.php");

isLoggedIn();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  echo "Connection failed";
} else {

  echo "Connection succesfull";
  echo "<br>";

  
  if($data["action"] == "project"){

  checkIfSet($_POST);

    $technieken = (checkIfTechniekSet($_POST["technieken"]));

    $queryImg = "select ID from afbeeldingen inner join technieken on technieken.afbeeldingID = afbeeldingen.ID where techniek = '".$technieken[0]."'";
    $techniekImg = mysqli_fetch_assoc(mysqli_query($conn, $queryImg))["ID"];

    $projectID = insertProject($data, $techniekImg);

    insertPTechnieken($technieken, $projectID);

    $IDS = saveImages($_FILES["afbeeldingen"]);
    insertPAfbeeldingen($IDS, $projectID);

  } else if($data["action"] == "techniek"){

    isImgUploaded();
    isTechniekSet();

    $file = $_FILES["afbeeldingen"];
    $imgName = $file["name"];

    // save the img to the server
    $target_dir = "./img/";
    $target_file = $file["tmp_name"];
    $newName = time().".".getExtension($file["type"]);	
    rename($file["tmp_name"], $target_dir.$newName);

    $query = "INSERT INTO afbeeldingen (link) VALUES ('".$newName."')";
    mysqli_query($conn, $query);
    $id = mysqli_insert_id($conn);

    mysqli_query($conn, $query);

  } else {
    echo "No action";
  }


}
$conn->close();

function insertProject($data, $techniekImg){
  global $conn;
  $query = "INSERT INTO projecten (projectNaam, omschrijving, techniekImg, github, productLink) 
  VALUES ('".$data["projectNaam"]."', '".$data["omschrijving"]."', '".$techniekImg."', '".$data["github"]."', '".$data["productLink"]."')";
  echo mysqli_query($conn, $query);
  return mysqli_insert_id($conn);
}

function InsertPTechnieken($technieken, $id){
  global $conn;
  foreach($technieken as $techniek){
    $query = "INSERT INTO projectenPivotTechnieken (projectID, techniekID) VALUES ('".$id."', '".$techniek."')";
    mysqli_query($conn, $query);
  }
}

function insertPAfbeeldingen($IDS, $id){
  global $conn;
  foreach($IDS as $imgID){
    echo $imgID;
    $query = "INSERT INTO projectenPivotAfbeeldingen (projectID, afbeeldingID) VALUES ('".$id."', '".$imgID."')";
    mysqli_query($conn, $query);
  }
}

function saveImages($files){
  $IDS = new ArrayObject();
  $target_dir = "./img/";
  
  for($i = 0; $i < count($files["name"]); $i++){
   $file = array(
     "name" => time().".".$i.".".getExtension($files["type"][$i]),
     "type" => $files["type"][$i],
     "tmp_name" => $files["tmp_name"][$i],
     "error" => $files["error"][$i],
     "size" => $files["size"][$i]
   );
   rename($file["tmp_name"], $target_dir.$file["name"]);
    $IDS->append(insertImage($file["name"]));
  }
  return $IDS;
}

function insertImage($image){
  $query = "INSERT INTO afbeeldingen (link) VALUES ('".$image."')";
  mysqli_query($GLOBALS["conn"], $query);
  return mysqli_insert_id($GLOBALS["conn"]);
}

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

function isImgUploaded(){
  if($_FILES["afbeeldingen"]["name"] == "" || $_FILES["afbeeldingen"] == null){
    echo "No file";
    die();
  }
}

function isTechniekSet(){
  $data = $_POST;
  if($data["techniek"] == "" || $data["techniek"] == null){
    echo "No techniek";
    die();
  }
}

function checkIfSet($data){
  foreach($data as $key => $value){
    if($value == "" || $value == null){
      echo "No ".$key;
      die();
    }
  }
}

function checkIfTechniekSet($technieken){
  $selectedTechnieken = new ArrayObject();
  foreach($technieken as $key => $value){
    // if key contain techniek
      if($value != "" && $value != null && $value != "null" && $value != null){
        $selectedTechnieken->append($value);
    }
  }
  if($selectedTechnieken->count() == 0){
    echo "No technieken";
    die();
  } 
  return $selectedTechnieken;
}

// header("Location: admin.php");