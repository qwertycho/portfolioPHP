<?php

require("modules/auth.php");
require("modules/secret.php");

isLoggedIn(); 

try{
    $projectID = $_GET['ID'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT ID FROM projecten WHERE ID = $projectID JOIN projectenPivotTechnieken ON projecten.ID = projectenPivotTechnieken.projectID";
    

    mysqli_query($conn, $sql);

    // header("Location: admin.php");

} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), " ";
}
