<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


global $keys;
global $conn;
$conn = mysqli_connect($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);

function getProjecten(){
    global $conn;
    $projectenSQL = "SELECT * from projecten";
    $projecten = mysqli_query($conn, $projectenSQL);
    $projecten = $projecten->fetch_all(MYSQLI_ASSOC);
    return $projecten;
}

function getProject($id){
    global $selectedProject;
    global $conn;

    // $conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);
    $getSQL = "SELECT * from projecten WHERE ID = " . $id;	
    $selectedProject = mysqli_query($conn, $getSQL);
    $selectedProject = $selectedProject->fetch_all(MYSQLI_ASSOC);

    $selectedProject = array_values($selectedProject)[0];

    $getSQL = "SELECT techniekID AS techniek from projectenPivotTechnieken WHERE projectID = " . $id;
    $selectedtTechnieken = mysqli_query($conn, $getSQL);
    $selectedProject['technieken'] = $selectedtTechnieken->fetch_all(MYSQLI_ASSOC);

    $getSQL = "SELECT link AS afbeelding from afbeeldingen WHERE projectID = " . $id;
    $selectedtAfbeeldingen = mysqli_query($conn, $getSQL);
    $selectedProject['afbeeldingen'] = $selectedtAfbeeldingen ->fetch_all(MYSQLI_ASSOC);

    return $selectedProject;
}

function getTechnieken(){
    global $keys;

    $conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);
    $techniekenSQL = "SELECT techniek AS techniek, afbeelding AS thumbnail from technieken";
    $technieken = $conn->query($techniekenSQL);
    $technieken = $technieken->fetch_all(MYSQLI_ASSOC);
    return $technieken;
}

function getSelectedTechnieken($id){
    global $conn;

    $techniekenSQL = "SELECT techniekID AS techniek from projectenPivotTechnieken WHERE projectID = " . $id;
    $technieken = mysqli_query($conn, $techniekenSQL);
    $technieken = $technieken->fetch_all(MYSQLI_ASSOC);
    return $technieken;
}