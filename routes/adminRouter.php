<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("modules/secret.php");
require_once("Router.php");
require_once("modules/fetch.php");
require_once("modules/newTechniek.php");
require_once("modules/newProject.php");

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
    $Techniek = new Techniek();
    try{
        $Techniek->newTechniek($_POST);
        header('Location: /admin');
    } catch(Exception $e){
        echo $e->getMessage();
    }
});

$Router->match('/admin/newProject', function(){
    try{
        Project::newProject($_POST);
        // header('Location: /admin');
    } catch(Exception $e){
        echo $e->getMessage();
    }
});

global $technieken;
global $projecten;
 
$technieken = getTechnieken();

$Router->render('/admin', 'admin');
