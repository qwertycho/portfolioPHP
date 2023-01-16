<?php

require('Router.php');


$Router->setPublic('/public');

$Router->render('/', 'index');
$Router->render('/index', 'index');

$Router->render('/contact', 'contact');

$Router->match('/projecten', function(){
    require __DIR__ . '/views/projecten.php';
});


$Router->catch('/', function(){
    echo '404';
});