<?php
//Author(s): Beesham Sarendranauth
include_once("../utils/UserManager.php");
include_once("login_user.php");
include_once("../utils/HTTPUtils.php");

session_start();
if(array_key_exists('firstname', $_POST) &&
   array_key_exists('lastname', $_POST) &&
   array_key_exists('email', $_POST) &&
   array_key_exists('password', $_POST) &&
   count($_POST) == 4 ) {
    
    if(UserManager::checkIfUserExist(htmlspecialchars($_POST['email']), ENT_QUOTES)) {
        $_SESSION['firstname'] = $_POST['firstname'];
        $_SESSION['lastname'] = $_POST['lastname'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['registration_error'] = failed;     
                
        HTTPUtils::redirectPage("/php/homepage.php");
    } else {
        $status = UserManager::addUser(
                            htmlspecialchars($_POST['firstname'], ENT_QUOTES),
                            htmlspecialchars($_POST['lastname'], ENT_QUOTES),
                            htmlspecialchars($_POST['email'], ENT_QUOTES),
                            htmlspecialchars($_POST['password'], ENT_QUOTES));
        if($status) {
            login_user_registered(htmlspecialchars($_POST['email'], ENT_QUOTES),
                                    htmlspecialchars($_POST['password'], ENT_QUOTES));
        }
    }
}
?>
