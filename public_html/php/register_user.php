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
    
    //TODO: check if user already exists. register user

    if(UserManager::checkIfUserExist($_POST['email'])) {
        //TODO: user exists send error
    } else {
        $status = UserManager::addUser($_POST['firstname'],$_POST['lastname'],$_POST['email'],$_POST['password']);
        echo $status;
        if($status) {
            login_user_registered($_POST['email'], $_POST['password']);
        }
    }
}
?>
