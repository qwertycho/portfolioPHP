<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("modules/secret.php");
require_once("Router.php");
require_once("modules/fetch.php");
require_once("modules/newTechniek.php");
require_once("modules/newProject.php");
require_once("modules/StatusResponse.php");
require_once("modules/TestUpdate.php");

global $keys;
global $Router;

if(isset($_POST['password'])){
    if($_POST['password'] == $keys->ADMIN_PASS){
        session_start();
        $_SESSION['loggedin'] = true;
        header('Location: /admin');
        die();
    }
    die();
}

$Router->render('/admin/login', 'login');

session_start();
if( !isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true ){
    header('Location: /admin/login');
    die();
}

$Router->match('/admin/newTechniek', function(){
    try{
        Techniek::newTechniek($_POST);
        header('Location: /admin');
    } catch(Exception $e){
        echo $e->getMessage();
    }
});

$Router->match('/admin/newProject', function(){
    try{
        Project::newProject($_POST);
        header('Location: /admin');
    } catch(Exception $e){
        echo $e->getMessage();
    }
});

$Router->match('/admin/updateTechniek', function(){
    try{
        Techniek::update($_POST);
        header('Location: /admin');
    } catch(Exception $e){
        echo $e->getMessage();
    }
});



global $technieken;
global $projecten;
 
$technieken = Fetch::getTechnieken();
$projecten = Fetch::getProjecten();

$Router->match('/admin/bewerk/update', function(){
   $data = json_decode(file_get_contents('php://input'), true);

    // fields controleren
    testUpdate::test($data);
    $naam = str_replace("<br>", "", $data['naam']);
    $naam = str_replace("&nbsp;", "", $naam);
    $naam = trim($naam);
    
    $omschrijving = trim($data['omschrijving']);
    $project = [
        'id' => $data['id'],
        'naam' => $naam,
        'omschrijving' => $omschrijving,
        'technieken' => [$data['techniek'][0]]
    ];

// techniekn array vullen
    foreach($data['techniek'] as $techniek){
        if($techniek != $data['techniek'][0] && $techniek != null && $techniek != "null" && $techniek != ""){
            array_push($project['technieken'], $techniek);
        }
    }

    Project::update($project);

    echo json_encode(new statusResponse("ok", "Project is succesvol geupdate!"));

});

$Router->match('/admin/bewerk/delete', function(){
   $data = json_decode(file_get_contents('php://input'), true);

    $project = [
        'id' => $data['id'],
    ];

    Project::delete($project);

    echo json_encode(new statusResponse("ok", "Project is succesvol geupdate!"));

});

$Router->params('/admin/bewerk/', function($id) {
    $id = intval($id);
    if($id > 0) {
        global $selectedProject;

        $selectedProject = Fetch::getProject($id);

        global $Router;
        $Router->render("/admin/bewerk/" . $id, 'bewerk');
    }
});

$Router->render('/admin', 'admin');