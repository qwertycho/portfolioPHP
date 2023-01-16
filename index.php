<?php

require('Router.php');


$Router->any('/', function(){
    require __DIR__ . '/views/index.php';
});

$Router->any('/contact', function(){
    require __DIR__ . '/views/contact.php';
});

$Router->params('/kip', function($params){
    // boktor
});

$Router->route('/kip', function(){
    require __DIR__ . '/views/index.php';
});