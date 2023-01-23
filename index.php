<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('Router.php');
require_once('./modules/secret.php');
require_once('./modules/fetch.php');

global $keys;
$keys = new Secrets();

$Router->render('/contact', 'contact');

global $technieken;
$technieken = Fetch::getTechnieken();
$Router->render('/cv', 'cv');


$Router->route('/projecten', 'projectenRouter');
$Router->route('/project/', 'projectenRouter');
$Router->route('/admin', 'adminRouter');
$Router->route('/api', 'apiRouter');
$Router->route('/', 'indexRouter');



$Router->catch('/', function(){
    echo '404';
});