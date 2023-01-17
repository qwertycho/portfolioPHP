<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "modules/secret.php";
require_once("Router.php");
require_once("modules/fetch.php");

global $keys;

$Router = new Router();

$conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$Router->params('/projecten', function($id) {
        global $projecten;
        global $technieken;
        $technieken = getTechnieken();
        global $Router;
        $projecten = getProjecten();

        $newProjecten = array();

        foreach($projecten as $project) {
            $Selectedtechnieken = getSelectedtechnieken($project['ID']);
            $project['technieken'] = $Selectedtechnieken;
            $newProjecten[] = $project;
        }


        $projecten = $newProjecten;

        $Router->render("/projecten" . $id, 'projecten');
        die();
});

$Router->params('/project/', function($param) {
    $id = intval($param);
    if($id > 0) {
        global $selectedProject;

        $selectedProject = getProject($id);

        global $Router;
        $Router->render("/project/" . $id, 'project');
    }
});

$Router->render('/projecten', 'projecten');