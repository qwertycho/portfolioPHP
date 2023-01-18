<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("modules/secret.php");
require_once("Router.php");
require_once("modules/fetch.php");
require_once("modules/newTechniek.php");

global $keys;
global $Router;


$Router->render('/admin/login', 'login');

global $technieken;
global $projecten;
 
$technieken = getTechnieken();

$Router->render('/', 'index');
$Router->render('/index', 'index');