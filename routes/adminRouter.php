<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("modules/secret.php");
require_once("Router.php");

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



$Router->render('/admin', 'admin');

$conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

