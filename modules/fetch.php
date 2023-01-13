<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("./modules/secret.php");

$conn = new mysqli($servername, $username, $password, $dbname);

function getTechnieken(){
    $sql = "SELECT techniek, link FROM technieken INNER JOIN afbeeldingen ON technieken.afbeeldingID = afbeeldingen.id";
    $result = mysqli_query($GLOBALS["conn"], $sql);

    return $result->fetch_all(MYSQLI_ASSOC);
}

function getProjecten(){
    $sql = "SELECT projecten.ID, projectNaam, omschrijving, github, productLink, afbeeldingen.link as techniekImg
    FROM projecten
    INNER JOIN afbeeldingen ON projecten.techniekImg = afbeeldingen.ID
    ";

    $projecten = mysqli_query($GLOBALS["conn"], $sql);
    $projecten = $projecten->fetch_all(MYSQLI_ASSOC);

    foreach ($projecten as $project => $value) {

        $projecten[$project]['technieken'] = [];
        $projecten[$project]['images'] = [];

        $projecten[$project]['technieken'] = getTechniekenFromProject($value['ID']);
        $projecten[$project]['images'] = getAfbeeldingenFromProject($value['ID']);

    }

    return $projecten;
}

function getProject($id){
    $sql = "SELECT * FROM projecten WHERE ID = ".$id;
    $result = mysqli_query($GLOBALS["conn"], $sql);

    $result = $result->fetch_all(MYSQLI_ASSOC);
    $project = $result[0];
    $project['technieken'] = [];
    $project['images'] = [];

    $project['technieken'] = getTechniekenFromProject($id);
    $project['images'] = getAfbeeldingenFromProject($id);

    return $project;
}

function getTechniekenFromProject($ID){
    $sql = "SELECT techniekID FROM projecten
    JOIN projectenPivotTechnieken ON projecten.ID = projectenPivotTechnieken.projectID
    WHERE projecten.ID = ".$ID;

    $technieken = mysqli_query($GLOBALS["conn"], $sql);
    $technieken = $technieken->fetch_all(MYSQLI_ASSOC);

    $arr = [];

    foreach ($technieken as $value) {
        array_push($arr, $value['techniekID']);
    }

    return $arr;
}

function getAfbeeldingenFromProject($ID){
    $sql = " SELECT link FROM projectenPivotAfbeeldingen
    left JOIN afbeeldingen ON afbeeldingen.ID = projectenPivotAfbeeldingen.afbeeldingID
    WHERE projectenPivotAfbeeldingen.projectID = ".$ID;

    $result = mysqli_query($GLOBALS["conn"], $sql);

    $images = [];
    
    foreach ($result->fetch_all(MYSQLI_ASSOC) as $value) {
        array_push($images, $value['link']);
    }

    return $images;
}