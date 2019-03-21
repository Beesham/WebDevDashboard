<?php
//Author(s): Beesham Sarendranauth
include_once("../utils/UserManager.php");
include_once("login_user.php");

session_start();
if(array_key_exists('firstname', $_POST) &&
   array_key_exists('lastname', $_POST) &&
   array_key_exists('email', $_POST) &&
   array_key_exists('password', $_POST) &&
   count($_POST) == 4 ) {
    
    if(UserManager::checkIfUserExist(htmlspecialchars($_POST['email']), ENT_QUOTES)) {
        //TODO: user exists send error
        $_SESSION = "";
    } else {
        $status = UserManager::addUser(
                            htmlspecialchars($_POST['firstname'], ENT_QUOTES),
                            htmlspecialchars($_POST['lastname'], ENT_QUOTES),
                            htmlspecialchars($_POST['email'], ENT_QUOTES),
                            htmlspecialchars($_POST['password'], ENT_QUOTES));
        echo $status;
        if($status) {
            login_user_registered(htmlspecialchars($_POST['email'], ENT_QUOTES),
                                    htmlspecialchars($_POST['password'], ENT_QUOTES));
        }
    }
}
?>
