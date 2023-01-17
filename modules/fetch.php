<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("secret.php");

// global $keys;

function getProjecten(){
    global $keys;
    $conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);
    $projectenSQL = "SELECT * from projecten";
    $projecten = $conn->query($projectenSQL);
    $projecten = $projecten->fetch_all(MYSQLI_ASSOC);
    return $projecten;
}

function getProject($id){
    global $selectedProject;
    global $keys;

    $conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);
    $getSQL = "SELECT * from projecten WHERE ID = " . $id;	
    $selectedProject = $conn->query($getSQL);
    $selectedProject = $selectedProject->fetch_all(MYSQLI_ASSOC);

    $selectedProject = array_values($selectedProject)[0];

    $getSQL = "SELECT techniekID AS techniek from projectenPivotTechnieken WHERE projectID = " . $id;
    $selectedtTechnieken = $conn->query($getSQL);
    $selectedProject['technieken'] = $selectedtTechnieken->fetch_all(MYSQLI_ASSOC);

    $getSQL = "SELECT link AS afbeelding from afbeeldingen WHERE projectID = " . $id;
    $selectedtAfbeeldingen = $conn->query($getSQL);
    $selectedProject['afbeeldingen'] = $selectedtAfbeeldingen ->fetch_all(MYSQLI_ASSOC);

    return $selectedProject;
}

function getTechnieken(){
    global $keys;

    $conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);
    $techniekenSQL = "SELECT techniek AS techniek from technieken";
    $technieken = $conn->query($techniekenSQL);
    $technieken = $technieken->fetch_all(MYSQLI_ASSOC);
    return $technieken;
}

function getSelectedTechnieken($id){
    global $keys;

    $conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);
    $techniekenSQL = "SELECT techniekID AS techniek from projectenPivotTechnieken WHERE projectID = " . $id;
    $technieken = $conn->query($techniekenSQL);
    $technieken = $technieken->fetch_all(MYSQLI_ASSOC);
    return $technieken;
}