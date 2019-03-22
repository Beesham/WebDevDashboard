<?php
//Author(s): Beesham Sarendranauth

    session_start();
    include_once("../../extras/adminConfig.php");
    include_once("../utils/HTTPUtils.php");
    include_once("../utils/UserManager.php"); 

login_user();
function login_user() {    
    if (array_key_exists('username', $_POST)
        && array_key_exists('password', $_POST)
        && count($_POST) == 2) {

        $status = UserManager::login_user($_POST['username'], $_POST['password']);  
        if($status) {
            $_SESSION["logged_in"] = true;
            $_SESSION['username'] = $_POST['username'];
            UserManager::getUser($_POST['username']);
            HTTPUtils::redirectPage("/html/mainpage.html");
        } else {
            $_SESSION["logged_in"] = false;
            $_SESSION['invalid_credentials'] = invalid;
            HTTPUtils::redirectPage("/php/homepage.php");
        }
    } 
    
}

function login_user_registered($username, $password) {
    $status = UserManager::login_user($username, $password);  
    if($status) {
        $_SESSION["logged_in"] = true;
        UserManager::getUser($_POST['username']);
        HTTPUtils::redirectPage("/html/mainpage.html");
    } else {
        $_SESSION["logged_in"] = false;
    }
}

?>


