<?php

require("./modules/secret.php");

function login($password){
    if($password == $GLOBALS["adminPass"]){
        $_SESSION["loggedIn"] = true;
        return true;
    } else {
        return false;
    }
}

function logout(){
    session_destroy();
}

function isLoggedIn(){
    session_start();
    if(isset($_SESSION["loggedIn"])){
        return true;
    } else {
        header("Location: login.php");
        die();
    }
}