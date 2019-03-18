<?php
    session_start();
    include("../../extras/adminConfig.php");
    include("../utils/DatabaseUtils.php");
    
    if (array_key_exists('username', $_POST)
        && array_key_exists('password', $_POST)
        && count($_POST) == 2) {

        DatabaseUtils::login($_POST['username'], $_POST['password']);  
        //DatabaseUtils::logout();
    } else {
        //TODO
        //invalid login info
    }
?>


