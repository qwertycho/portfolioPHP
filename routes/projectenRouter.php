<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "modules/secret.php";
require_once("Router.php");

global $keys;
$keys = new Secrets();


$Router = new Router();

$conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

global $projecten;

$projectenSQL = "SELECT * from projecten";
$projecten = $conn->query($projectenSQL);
$projecten = $projecten->fetch_all(MYSQLI_ASSOC);

global $technieken;

$techniekenSQL = "SELECT techniek AS id from technieken";
$technieken = $conn->query($techniekenSQL);
$technieken = $technieken->fetch_all(MYSQLI_ASSOC);

$Router->params('/projecten', function($id) {
        global $Router;
        $Router->render("/projecten" . $id, 'projecten');
        die();
});

$Router->params('/project/', function($id) {
    if(strlen($id) > 0) {
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


        global $Router;
        $Router->render("/project/" . $id, 'project');
    }
    die();
});

$Router->render('/projecten', 'projecten');