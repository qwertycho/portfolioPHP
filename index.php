<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('Router.php');
require_once('./modules/secret.php');

$Router->setPublic('/public');

$Router->render('/', 'index');
$Router->render('/index', 'index');

$Router->render('/contact', 'contact');

$Router->match('/projecten', function(){
    require __DIR__ . '/routes/projectenRouter.php';
});


$Router->catch('/', function(){
    echo '404';
});