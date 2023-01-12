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
    // one row per record
    $sql = "SELECT projecten.ID, projectNaam, omschrijving, github, productLink, afbeeldingen.link as techniekImg
    FROM projecten
    INNER JOIN afbeeldingen ON projecten.techniekImg = afbeeldingen.ID
    ";

    $projecten = mysqli_query($GLOBALS["conn"], $sql);
    $projecten = $projecten->fetch_all(MYSQLI_ASSOC);

    foreach ($projecten as $project => $value) {
        $sql = "SELECT techniekID FROM projecten
        JOIN projectenPivotTechnieken ON projecten.ID = projectenPivotTechnieken.projectID
        WHERE projecten.ID = ".$value['ID'];

        $technieken = mysqli_query($GLOBALS["conn"], $sql);
        $technieken = $technieken->fetch_all(MYSQLI_ASSOC);

        $sql = "SELECT link FROM afbeeldingen
        JOIN projectenPivotAfbeeldingen ON afbeeldingen.ID = projectenPivotAfbeeldingen.afbeeldingID
        WHERE projectenPivotAfbeeldingen.projectID = ".$value['ID'];

        $images = mysqli_query($GLOBALS["conn"], $sql);
        $images = $images->fetch_all(MYSQLI_ASSOC);

        $projecten[$project]['technieken'] = [];
        $projecten[$project]['images'] = [];

        foreach ($technieken as $value) {
            array_push($projecten[$project]['technieken'], $value['techniekID']);
        }

        foreach ($images as $value) {
            array_push($projecten[$project]['images'], $value['link']);
        }

    }

    return $projecten;
}

function getProject($id){
    $sql = "SELECT * FROM projecten WHERE ID = ".$id;

    $result = mysqli_query($GLOBALS["conn"], $sql);

    return $result->fetch_all(MYSQLI_ASSOC);
}