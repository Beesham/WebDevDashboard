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

        $status = UserManager::login_user(htmlspecialchars($_POST['username'], ENT_QUOTES),
                                            htmlspecialchars($_POST['password'], ENT_QUOTES));  

        if($status) {
            $_SESSION['logged_in'] = 'true';
            $_SESSION['username'] = $_POST['username'];
            unset($_SESSION['invalid_credentials']);
            
            global $admin_username;

            if(strcmp($_POST['username'], $admin_username)) {
                $_SESSION['is_admin'] = 'true';
            }
            HTTPUtils::redirectPage("/php/mainpage.php");
        } else {
            $_SESSION['logged_in'] = false;
            $_SESSION['invalid_credentials'] = 'invalid';
            HTTPUtils::redirectPage("/php/homepage.php");
        }
    } 
    
}

function login_user_registered($username, $password) {
    $status = UserManager::login_user($username, $password);  
    if($status) {
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;
        unset($_SESSION['registration_error']);
        UserManager::getUser(htmlspecialchars($_POST['username'], ENT_QUOTES));
        HTTPUtils::redirectPage("/php/mainpage.php");
    } else {
        $_SESSION['logged_in'] = false;
    }
}

?>


